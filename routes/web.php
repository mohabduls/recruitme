<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//routing to home public
Route::get('/','PublicController@index');

//routing login to dashboard
Route::get('/login','LoginController@index');

//routing login
Route::post('/auth','LoginController@auth');
//routing logout
Route::get('dashboard/logout','LoginController@logout');

//routing dashboard
Route::get('dashboard','DashboardController@index');

//routing update company profiles
Route::post('dashboard/company/update','DashboardController@updateCompany');

//routing fetch company data
Route::get('dashboard/company/data','DashboardController@getCompanyData');

//routing add categories
Route::post('dashboard/categories/add','DashboardController@postCategories');
//routing update categories
Route::post('dashboard/categories/update','DashboardController@updateCategories');
//routing delete categories
Route::post('dashboard/categories/delete','DashboardController@deleteCategories');

//routing for job post or post a job
Route::post('dahsboard/job/add','DashboardController@postJob');
//routing for edit job post or post a job
Route::post('dahsboard/job/edit','DashboardController@editJob');
//routing for delete jobs
Route::post('dashboard/job/delete','DashboardController@deleteJob');

//routing for get job post data
Route::post('dashboard/job/details','DashboardController@getJobPostData');

//routing for see job pages
Route::get('job/{hash}','JobPageController@see');

//routing for candidate apply
Route::post('job/apply','JobPageController@apply');

//routing get applicants data
Route::post('dashboard/applicants/data','DashboardController@getApplicantsData');

//routing for delete applicants
Route::get('dashboard/applicants/delete/{id}','DashboardController@deleteApplicants');

//routing for change status of applicants from true to false or the other way
Route::post('dashboard/applicants/status','DashboardController@changeStatus');

//routing for vacany lists
Route::get('vacancy','JobPageController@index');

//routing for update login
Route::post('dashboard/settings/update','LoginController@updateAuth');