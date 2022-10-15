<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $jobApplications = JobApplication::where('company_id',auth()->user()->company->id)->get();
        return view('admin.pages.jobApplication.index',compact('jobApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'company_id'=>'required',
            'job_id'=>'required',

        ]);

        $applied = JobApplication::where('job_id',$request->job_id)->where('user_id',auth()->user()->id)->first();
        if($applied){
            return redirect()->back()->with(['error' => 'You have already applied for this job.']);
        }
        $application = JobApplication::create([
            'user_id'=>auth()->user()->id,
            'company_id'=>$request->company_id,
            'job_id'=>$request->job_id,
            'apply_date'=>Carbon::now(),

        ]);

        $job = job::findOrFail($request->job_id);
        $job->application_count+=1;
        $job->save();
       

        if($application){
            return redirect()->back()->with(['success' => 'Job Application  submitted successfully!!']);
        }else{
            return redirect()->back()->with(['error' => 'Internal server error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function show(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }


}
