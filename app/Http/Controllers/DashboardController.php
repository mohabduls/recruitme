<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use File;

use App\JobPost;
use App\Company;
use App\Categories;
use App\Applicants;

class DashboardController extends Controller
{
    function index(){
    	if(!empty(Session::get('admin'))){

            $dataCategories = Categories::orderBy('id','DESC')->paginate(5,['*'],'cat_page');
            $dataJobPosts = JobPost::orderBy('id','DESC')->paginate(5,['*'],'job_page');
            $dataCompany = Company::get();
            $dataApplicants = Applicants::orderBy('id','DESC')->paginate(5,['*'],'applicants_page');
            $dataWhiteLists = Applicants::where('status',true)->orderBy('id','DESC')->paginate(5,['*'],'whitelists');
    		return view('layout.dashboard')->with(compact('dataCategories',$dataCategories))->with(compact('dataJobPosts',$dataJobPosts))->with(compact('dataCompany',$dataCompany))->with(compact('dataApplicants',$dataApplicants))->with(compact('dataWhiteLists',$dataWhiteLists));
    	}
    	else{
    		return redirect(url('login'));
    	}
    }

    function updateCompany(Request $request){
        if(!empty(Session::get('admin'))){
            $this->validate($request,[
                'companyName' => 'required',
                'companyLogo' => 'required|mimes:jpg,jpeg,png',
                'companyAddress' => 'required',
                'companySlogan' => 'required'
            ]);

            $name = $request->input('companyName');
            $address = $request->input('companyAddress');
            $slogan = $request->input('companySlogan');

            $file = $request->file('companyLogo');

            $filename = date('d-m-Y').'-'.str_replace(' ','',$file->getClientOriginalName());

            $folder = 'data/company/';
            $file->move($folder,$filename);
            $data = Company::first();
            if(!$data){
                $insert = Company::insert([
                    'name' => $name,
                    'address' => $address,
                    'slogan' => $slogan,
                    'logo' => url($folder.$filename)
                ]);
                if($insert){
                    return back();
                }
                else{
                    return back()->withErrors(['Errors' => 'Can\'t update your company profiles!']);
                }
            }
            else{
                $update = Company::where('id',$data->id)->update([
                    'name' => $name,
                    'address' => $address,
                    'slogan' => $slogan,
                    'logo' => url($folder.$filename)
                ]);

                if($update){
                    return back();
                }
                else{
                    return back()->withErrors(['Errors' => 'Can\'t update your company profiles!']);
                }
            }
        }
        else{
            return redirect(url('login'))->withErrors('Please login before access dashboard!');
        }
    }

    
    function postCategories(Request $request){
    	$this->validate($request,[
            'categories' => 'required'
        ]);
        $categories = $request->input('categories');
        $check = Categories::where('categories',$categories)->first();
        if(!$check){
            $data = Categories::insert([
                'categories' => $categories,
                'created_at' => now()
            ]);
            if($data){
                return back();
            }
            else{
                return back()->withErrors(['Errors' => 'Can\'t add categories!']);
            }
        }
        else{
            return back()->withErrors(['Errors' => 'This categories has exist!']);
        }
    }

    function postJob(Request $request){
        $this->validate($request,[
            'jobTitle' => 'required',
            'jobCategories' => 'required',
            'jobPosts' => 'required'
        ]);

        $jobTitle = $request->input('jobTitle');
        $jobPosts = $request->input('jobPosts');
        $jobCategories = $request->input('jobCategories');
        $jobPermalink = md5($jobTitle);

        $data = JobPost::insert([
            'title' => $jobTitle,
            'categories' => $jobCategories,
            'posts' => $jobPosts,
            'permalink' => $jobPermalink,
            'created_at' => now()
        ]);

        if($data){
            return back();
        }
        else{
            return back()->withErrors(['Errors' => 'Failed to add job posts!']);
        }
    }

    function editJob(Request $request){
        if(!empty(Session::get('admin'))){
            $this->validate($request,[
                'jobTitle' => 'required',
                'jobCategories' => 'required',
                'jobPosts' => 'required',
                'hash' => 'required'
            ]);

            $jobTitle = $request->input('jobTitle');
            $jobPosts = $request->input('jobPosts');
            $jobCategories = $request->input('jobCategories');
            $hash = $request->input('hash');

            $data = JobPost::where('permalink',$hash)->first();
            if($data){
                $update = JobPost::where('permalink',$hash)->update([
                    'title' => $jobTitle,
                    'categories' => $jobCategories,
                    'posts' => $jobPosts,
                    'updated_at' => now()
                ]);
                if($update){
                    return back();
                }
                else{
                    return back()->withErrors(['Errors' => 'Failed to edit job posts!']);
                }
            }
            else{
                return back()->withErrors(['Errors' => 'Failed to edit job posts!']);
            }    
        }
        else{
            return back()->withErrors(['Errors' => 'Please login before access this content!']);
        }
               
    }

    function deleteJob(Request $request){
        if(!empty(Session::get('admin'))){
            $this->validate($request,[
                'hash' => 'required'
            ]);

            $hash = $request->post('hash');
            $data = JobPost::where('permalink',$hash)->delete();
            if(!$data){
                return ['status' => false];
            }
            else{
                return ['status' => true];
            }

        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access this content!']);
        }
    }

    function updateCategories(Request $request){
        if(!empty(Session::get('admin'))){
            $this->validate($request,[
                'id' => 'required|integer',
                'categories' => 'required'
            ]);

            $id = $request->post('id');
            $categories = $request->post('categories');

            $data = Categories::where('id',$id)->update([
                'categories' => $categories,
                'updated_at' => now()
            ]);

            if($data){
                return back();
            }
            else{
                return back()->withErrors(['Errors' => 'Failed to edit this Categories!']);
            }
        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access this content!']);
        }   
    }

    function deleteCategories(Request $request){
        if(!empty(Session::get('admin'))){
            $this->validate($request,[
                'id' => 'required|integer'
            ]);

            $id = $request->post('id');
            $data = Categories::where('id',$id)->delete();
            if(!$data){
                return ['status' => false];
            }
            else{
                return ['status' => true];
            }

        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access this content!']);
        }
    }

    //json response
    function getCompanyData(){
        if(!empty(Session::get('admin'))){
            $data = Company::first();
            return $data;
        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access dashboard!']);
        }
    }

    function getJobPostData(Request $request){
        if(!empty(Session::get('admin'))){
            $hash = $request->post('hash');
            $data = JobPost::where('permalink',$hash)->get();
            return $data;
        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access dashboard!']);
        }
    }

    //this for get detail of applicants
    function getApplicantsData(Request $request){
        if(!empty(Session::get('admin'))){
            $applicantsId = $request->post('id');
            $dataApplicants = Applicants::where('id',$applicantsId)->get();

            return $dataApplicants;
        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access dashboard!']);
        }
    }

    //this for deleting candidates
    function deleteApplicants($id){
        if(!empty(Session::get('admin'))){
            $data = Applicants::where('id',$id)->first();
            if($data){
                $deletePhotos = File::delete(str_replace(url('').'/','',$data->photos));
                $deleteArchive = File::delete(str_replace(url('').'/','',$data->files));
                if($deletePhotos == true && $deleteArchive == true){
                    $forceDelete = Applicants::where('id',$id)->delete();
                    if($forceDelete){
                        return back()->with(Session::Flash('success','This applicants has been deleted successfully!')); 
                    }
                    else{
                        return back()->withErrors(['Errors' => 'Sorry, we failed to delete your candidates!']);
                    }
                }
                else{
                    return back()->withErrors(['Errors' => 'Sorry, we failed to delete your candidates!']);
                }
            }
            else{
                return back()->withErrors(['Errors' => 'Sorry, we failed to delete your candidates!']);
            }
        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access dashboard!']);
        }
    }

    //this for change status of candidates which means that will be change to whitelisted or not
    function changeStatus(Request $request){
        if(!empty(Session::get('admin'))){
            $this->validate($request,[
                'id' => 'integer'
            ]);

            $id = $request->post('id');
            $status = $request->post('status');

            $data = Applicants::where('id',$id)->first();
            $data->status = $status;
            if($data->save()){
                return ['status' => true];
            }
            else{
                return ['status' => false];
            }
        }
        else{
            return redirect(url('login'))->withErrors(['Errors' => 'Please login before access dashboard!']);
        }
    }
}
