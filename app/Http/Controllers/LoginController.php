<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Administrator;
use Hash;

class LoginController extends Controller
{
    function index(){
    	return view('layout.login');
    }

    function auth(Request $request){
    	if(!empty(Session::get('admin'))){
    		return redirect('dashboard');
    	}
    	else{
    		$this->validate($request,[
	    		'username' => 'required',
	    		'password' => 'required'
	    	]);
    		$username = $request->input('username');
    		$password = $request->input('password');
    		$data = Administrator::where('username',$username)->first();

    		if($data){
    			if(Hash::check($password,$data->password)){
    				Session::put('admin',$data->id);
                    Session::put('username',$data->username);
    				return redirect(url('dashboard'));
    			}
    			else{
    				return back()->withErrors(['Error' => 'Username or Password incorrect!']);
    			}
    		}
    		else{
    			return back()->withErrors(['Error' => 'Username or Password incorrect!']);
    		}
    	}
    }

    //this for change password
    function updateAuth(Request $request){
        $this->validate($request,[
            'username' => 'required|min:5',
            'password' => 'required|min:6|confirmed:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'oldPassword' => 'required'
        ]);

        //validation
        $username = $request->input('username');
        $password = $request->input('password');
        //old password
        $oldPassword = $request->input('oldPassword');
        $data = Administrator::where('id',Session::get('admin'))->first();

        if($data){
            if(Hash::check($oldPassword,$data->password)){
                //new username and password here !
                $data->username = $username;
                $data->password = Hash::make($password);

                if($data->save()){
                    return back()->with(Session::Flash('success','Setting has been successfully saved!'));
                }
                else{
                    return back()->withErrors(['Error' => 'Sorry, we can\t proccess your request now!']);
                }
            }
            else{
                return back()->withErrors(['Error' => 'Password Confirmation incorrect!']);
            }
        }
        else{
            return back()->withErrors(['Error' => 'Username or Password incorrect!']);
        }
    }
    //logout
    function logout(){
    	Session::Flush();
    	return redirect(url('/login'));
    }
}
