<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
           
            'skills'=>'required',
            'qualities'=>'required',
            'country'=>'required',
            'work_preference'=>'required',
            'language'=>'required',
            'gender'=>'required',
            'dob'=>'required',
          
           
            
        ]);

        if($request->password && $request->confirm){
            if( $request->password == $request->confirm){
                $user= User::where('id',auth()->user()->id)->first();
                $user->password = Hash::make($request->password);
                $user->save();
            }else{
                return redirect()->back()->with(['error' => 'Password did not match']);
            }
           
        }
      
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = time() . '-' . Str::random(6) . '.' . $file->extension();
            $request->file('image')->move(public_path('images'), $path);
            $picture = '/images/'.$path;
        }

        if($request->hasFile('resume')){
            $file = $request->file('resume');
            $path = time() . '-' . Str::random(6) . '.' . $file->extension();
            $request->file('resume')->move(public_path('files'), $path);
            $file = '/files/'.$path;
        }

        $profile= Profile::updateOrCreate([
            'user_id'=>auth()->user()->id,
        ],[
            'skills'=>$request->skills,
            'qualities'=>$request->qualities,
            'country'=>$request->country,
            'work_preference'=>$request->work_preference,
            'language'=>$request->language,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'image'=>$picture ?? auth()->user()->profile->image,
            'resume'=>$file ?? auth()->user()->profile->resume,
            'user_id'=>auth()->user()->id,
            'about'=>$request->about,
            
        ]);

        
        if($profile){
            return redirect()->back()->with(['success' => 'Profile Updated successfully!!']);
        }else{
            return redirect()->back()->with(['error' => 'Internal server error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        
    }
}
