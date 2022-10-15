<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('user_id',auth()->user()->id)->where('status','active')->get();
        return view('admin.pages.job.index',compact('jobs'));
    }

    public function expiredjob(){
        $jobs = Job::where('user_id',auth()->user()->id)->where('status','expired')->get();
        return view('admin.pages.job.expired',compact('jobs'));  
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.job.create');
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
            'title'=>'required',
            'image'=>'required',
            'description'=>'required',
            'requirements'=>'required',
            'roles'=>'required',
            
            'expire_date'=>'required',
            'duration'=>'required',
            
        ]);

        
      
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = time() . '-' . Str::random(6) . '.' . $file->extension();
            $request->file('image')->move(public_path('images'), $path);
            $picture = '/images/'.$path;
        }


        $job= job::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'requirements'=>$request->requirements,
            'roles'=>$request->roles,
            'status'=>'active',
            'expire_date'=>$request->expire_date,
            'duration'=>$request->duration,
            'image'=>$picture ?? '',
            'user_id'=>auth()->user()->id,
            'company_id'=>auth()->user()->company->id
        ]);

        
        if($job){
            return redirect()->back()->with(['success' => 'Job added successfully!!']);
        }else{
            return redirect()->back()->with(['error' => 'Internal server error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(job $job)
    {
        $jobApplications = JobApplication::with('user','profile')->where('job_id',$job->id)->get();
        return view('admin.pages.job.view',compact('job','jobApplications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(job $job)
    {
        return view('admin.pages.job.edit',compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, job $job)
    {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'requirements'=>'required',
            'roles'=>'required',
          
            'duration'=>'required',
        ]);

        

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = time() . '-' . Str::random(6) . '.' . $file->extension();
            $request->file('image')->move(public_path('images'), $path);
            $picture= '/images/'.$path;
            $job->image=$picture;
        }

            $job->title=$request->title;
            $job->description=$request->description;
            $job->requirements=$request->requirements;
            $job->roles=$request->roles;
           
            $job->expire_date=$request->expire_date;
            $job->duration=$request->duration;
            $job->save();
            return redirect()->back()->with(['success'=>'Job Updated Successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(job $job)
    {
        if($job) {
            if(file_exists(public_path($job->image))){
                File::delete(public_path($job->image));
            } 
            $job->delete();
            return redirect()->back()->with(['success'=>'Job Deleted Successfully']);
        }
    }

   public function joblist(){
    $jobs = job::with('company')->where('status','active')->orderBy('created_at','DESC')->paginate(10);
    return view('user.joblist',compact('jobs'));
   }

   public function jobdetail($id){
    $job = job::with('company')->findOrFail($id);
    $applied = JobApplication::where('job_id',$id)->where('user_id',auth()->user()->id)->first();
    return view('user.jobdetail',compact('job','applied'));

   }

   public function decision(Request $request){
    $this->validate($request,[
        'action'=>'required',
        'application_id'=>'required'
    ]);

    $application = JobApplication::findOrFail($request->application_id);


    if($request->action == 'accept'){
        $application->status="accept";

    }else{
        $application->status="reject";

    }
    $application->save();
    return redirect()->back()->with(['success'=>'Job Application Updated Successfully']);

   }
}
