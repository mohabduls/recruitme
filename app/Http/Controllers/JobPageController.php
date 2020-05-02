<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\JobPost;
use App\Company;
use App\Applicants;
use App\Categories;

use Hash;

class JobPageController extends Controller
{

    //this for list job
    function index(Request $request){
        $find = $request->get('find');
        $categories = $request->get('cat');

        $dataCompany = Company::get();
        $dataCategories = Categories::get();

        if(!is_array($find) && !is_array($categories)){
            if(!empty($find) || !empty($categories)){
                $dataJobPosts = JobPost::where('title','LIKE','%'.$find.'%')->where('categories','LIKE','%'.$categories.'%')->paginate(10,['*'],'job_page');
            }
            else{
                $dataJobPosts = JobPost::paginate(10,['*'],'job_page');
            }
            return view('layout.joblists')->with(compact('dataJobPosts',$dataJobPosts))->with(compact('dataCompany',$dataCompany))->with(compact('dataCategories',$dataCategories));
        }
        else{
            return redirect(url(''));
        }
    }

    function see($hash){
    	$dataJobPosts = JobPost::where('permalink',$hash)->get();
        $dataCompany = Company::get();
    	return view('layout.job')->with(compact('dataJobPosts',$dataJobPosts))->with(compact('dataCompany',$dataCompany));
    }

    function apply(Request $request){
        $this->validate($request,[
            'candidateName' => 'required|min:5|max:30',
            'candidateAge' => 'required|integer|min:18|max:80',
            'candidateEducation' => 'required',
            'candidatePhotos' => 'required|file|max:2000|mimes:jpg,jpeg,png',
            'candidateEmail' => 'required|email',
            'candidatePhone' => 'required',
            'candidateAddress' => 'required|max:500',
            'candidateArchive' => 'required|file|max:5012|mimes:zip,rar,pdf,docx',
            'candidateApply' => 'integer'
        ]);

        $candidateName = $request->input('candidateName');
        $candidateAge = $request->input('candidateAge');
        $candidateEducation = $request->input('candidateEducation');
        $candidateEmail = $request->input('candidateEmail');
        $candidatePhone = $request->input('candidatePhone');
        $candidateAddress = $request->input('candidateAddress');
        $candidateApply = $request->input('candidateApply');

        //file handling
        $candidatePhotos = $request->file('candidatePhotos');
        $candidateArchive = $request->file('candidateArchive');

        //file information
        //photos and replace space with -
        $photosName = rand(1,1000)."-".str_replace(' ','-',$candidatePhotos->getClientOriginalName());
        //archive
        $acrhiveName = rand(1,1000)."-".str_replace(' ','-',$candidateArchive->getClientOriginalName());
        //folders
        $photosFolder = 'data/applicants/photos/';
        $archiveFolder = 'data/applicants/archive/';

        //validate this education using array because we are not using database
        $educationParam = ['High School','Diploma','Bachelor','Magister','Doctor'];

        if(!in_array($candidateEducation, $educationParam)){
            return back()->withErrors(['Errors' => 'Hello suspicious user!']);
        }
        else{
            //proccessing input candidate data to database
            $data = Applicants::insert([
                'name' => $candidateName,
                'age' => $candidateAge,
                'address' => $candidateAddress,
                'education' => $candidateEducation,
                'photos' => url($photosFolder.$photosName),
                'email' => $candidateEmail,
                'number_phone' => $candidatePhone,
                'files' => url($archiveFolder.$acrhiveName),
                'status' => false,
                'apply_id' => $candidateApply,
                'created_at' => now()
            ]);

            if($data){
                //move file and photos to the server
                $candidatePhotos->move($photosFolder, $photosName);
                $candidateArchive->move($archiveFolder,$acrhiveName);
                return back()->with(Session::Flash('success','Thankyou for your cv. we will contact you as soon as possible!'));
            }
            else{
                return back()->withErrors(['Errors' => 'Sorry, we failed to proccess your request!']);
            }
        }
    }
}
