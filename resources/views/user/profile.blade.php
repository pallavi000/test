@extends('layouts.app')
@section('content')
<div class="container">
    <div class="profile-header-section">
        <div class="profile-title">{{auth()->user()->name}}</div>
        <div class="profile-detail">{{auth()->user()->profile->about}}</div>
    </div>

    <form class="row justify-content-between" method="POST" action="{{route('profile.store')}}"  enctype="multipart/form-data">
        @csrf
        <div class="col-md-8 col-sm-12">
            <div class="profile-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-account">My Account</div>
                        
                    </div>
                </div>
                @if ($message = Session::get('error'))
                <div class="alert alert-danger"><b>Error </b>
                    <?php echo $message; ?>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success"><b>Success </b>
                    <?php echo $message; ?>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif
                <div class="card-body">
                    <div class="card-title my-3">USER INFORMATION</div>
                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" class="form-control" value="{{auth()->user()->name}}" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" disabled>
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" disabled class="form-control" value="{{auth()->user()->email}}" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Qualities</label>
                            <input type="text" class="form-control" value="{{auth()->user()->profile->qualities}}"  name="qualities" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Work Preference</label>
                            <input type="text" class="form-control" value="{{auth()->user()->profile->work_preference}}" name="work_preference" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Language</label>
                            <input type="text" class="form-control" value="{{auth()->user()->profile->language}}"  name="language" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Gender</label>
                            <select class="form-control" name="gender">
                                <option value="male" @if(auth()->user()->profile->gender=="male")selected @endif>Male</option>
                                <option value="female"  @if(auth()->user()->profile->gender=="female")selected @endif>Female</option>

                                <option value="other"  @if(auth()->user()->profile->gender=="other")selected @endif>Other</option>
                            </select>
                           
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="exampleInputEmail1"> In which skills you mastered..?</label>
                            <input type="text" class="form-control"  value="{{auth()->user()->profile->skills}}" name="skills" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Date of Birth</label>
                            <input type="date"  value="{{auth()->user()->profile->dob}}" class="form-control" name="dob" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Password *</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Confirm Password *</label>
                            <input type="password" name="confirm" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                    </div>

                    
                    <div class="card-title my-3">CONTACT INFORMATION</div>
                   
                        <div class="col form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <input type="text" class="form-control"  value="{{auth()->user()->profile->country}}" name="country" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>

                        
                  

                    <div class="card-title my-3">ABOUT ME</div>
                    <div class="col form-group mb-4">
                        <label for="exampleInputEmail1">About Me</label>
                        <textarea type="text" name="about"  class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="" rows="4">{{auth()->user()->profile->about}}</textarea>
                    </div>
                    <div class=" col form-group mb-4">
                        <label for="exampleInputEmail1">Profile Image</label>
                        <input class="form-control" type="file" name="image">
                    </div>

                    <div class=" form-group mb-4">
                        <label for="exampleInputEmail1">Resume</label>
                        <input class="form-control" type="file" name="resume">
                    </div>
                </div>
            
                <button class="btn btn-primary btn-lg mt-3">Submit</button>


            </div>
            </div>
      
        <div class="col-md-4 col-sm-12">
            <div class="user-card card">
                <div class="card-body">
                    <div class="profile-image">
                        <img src="{{auth()->user()->profile->image??'http://jaga247.com/dashboard/user/demo-user.png'}}"  class="img-fluid">
                    </div>
                    <div class="user-detail">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="user-rating-value">10</div>
                                <div class="user-rating">Internship</div>
                            </div>
                            <div class="col">
                                <div class="user-rating-value">4</div>
                                <div class="user-rating">Jobs</div>
                            </div>
                            <div class="col">
                                <div class="user-rating-value">6</div>
                                <div class="user-rating">Rating</div>
                            </div>
                        </div>

                        <div class="user-name">
                            {{auth()->user()->name}}
                        </div>
                        <div class="user-address">{{auth()->user()->profile->country}}</div>
                        <hr>
                       
                        <div class="about-me">{{auth()->user()->profile->about}}</div>

                    </div>

                </div>
            </div>
        </div>
    </form>


</div>
    
@endsection