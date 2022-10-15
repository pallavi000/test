<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::where('user_id',auth()->user()->id)->get();
        return view('admin.pages.company.index',compact('companies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.company.create');
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'country'=>'required',
            'phone'=>'required',
        ]);

        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'company',
        ]);

        $company = Company::create([
            'user_id'=>$user->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'country'=>$request->country,
            'phone'=>$request->phone,
            'website'=>$request->website,
            'logo'=>$request->logo,

        ]);
        if($company){
            return redirect()->back()->with(['success' => 'Company Register successfully!!']);
        }else{
            return redirect()->back()->with(['error' => 'Internal server error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        
        if($company->user_id==auth()->user()->id){
            return view('admin.pages.company.edit',compact('company'));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
       
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'country'=>'required',
            'phone'=>'required',
        ]);
    
       
        $company->name = $request->name;
        $company->email = $request->email;
        $company->country = $request->country;
        $company->phone = $request->phone;
        $company->website = $request->website;
        $company->logo = $request->logo;
        $company->save();
        return redirect()->back()->with(['success' => 'Company updated successfully!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        
        if($company){
            $company->delete();
             return redirect()->back()->with(['success' => 'Company deleted successfully!!']);

        }
    }

    public function register(){
        return view('auth.company.register');
    }
}
