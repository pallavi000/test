<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $applications = JobApplication::with('user','job')->where('company_id',auth()->user()->company->id)->orderBy('created_at','DESC')->limit(10)->get();
        return view('admin.pages.dashboard',compact('applications'));
    }

    public function profile(){
        return view('user.profile');
    }
}
