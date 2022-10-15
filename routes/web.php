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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/company/register',[App\Http\Controllers\CompanyController::class,'register'])->name('company.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('company',App\Http\Controllers\CompanyController::class);


Route::group(['middleware'=>'companyAuth'],function(){
    Route::get('/dashboard',[App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');
    Route::resource('job',App\Http\Controllers\JobController::class);
    Route::get('/jobs/expired',[App\Http\Controllers\JobController::class,'expiredjob'])->name('job.expired');
    Route::post('/application/decision',[App\Http\Controllers\JobController::class,'decision'])->name('application.decision');
});

Route::group(['middleware' => 'auth'], function () {
Route::resource('profile',App\Http\Controllers\ProfileController::class);
Route::resource('job-application',App\Http\Controllers\JobApplicationController::class);
Route::get('/job-list',[App\Http\Controllers\JobController::class,'joblist'])->name('job.list');
Route::get('/job-detail/{id}',[App\Http\Controllers\JobController::class,'jobdetail'])->name('job.detail');

});
