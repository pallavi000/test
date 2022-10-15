@extends('admin.layouts.sidebar')

@section('content')

<span class="text">Job</span>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <h4 class="card-title float-left">Job Detail</h4>
                    <div class="float-right mr-0">
                        <a href="{{route('job.index')}}" class="btn btn-primary">go Back</a>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-4">Job Title :</div>
                    <div class="col-md-8">{{$job->title}}</div>
                    <div class="col-md-4">Job Description :</div>
                    <div class="col-md-8">{{$job->description}}</div>
                    <div class="col-md-4">Requirements :</div>
                    <div class="col-md-8">{{$job->requirements}}</div>
                    <div class="col-md-4">Duration :</div>
                    <div class="col-md-8">{{$job->duration}}</div>
                    <div class="col-md-4">Role : </div>
                    <div class="col-md-8">{{$job->roles}}</div>
                    <div class="col-md-4">Status :</div>
                    <div class="col-md-8">{{$job->status}}</div>
                    <div class="col-md-4">Expire Date :</div>
                    <div class="col-md-8">{{$job->expire_date}}</div>
                </div>
                </div>
                
                <div class="card-header mb-3">
                    
                    <h4 class="card-title float-left">Job Applications</h4>
                </div>
                <div class="card-body p-0">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible "><b>Error </b>
                        <?php echo $message; ?>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible"><b>Success </b>
                        <?php echo $message; ?>
                    </div>
                    @endif


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>title</th>
                                    <th>Applicant Name</th>
                                    <th>Applicant Email</th>
                                    <th>Resume</th>
                                    <th>Status</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobApplications as $application)
                                <tr>
                                    <td>{{$application->id}}</td>
                                    <td>{{$job->title}}</td>
                                    
                                    <td>{{$application->user->name}}</td>
                                    <td>{{$application->user->email}}</td>
                                    <td><a href="{{asset($application->profile->resume)}}" target="_blank">download</a></td>
                                    <td>{{$application->status}}</td>
                                    
                                    <td class="d-flex">
                                       <form action="{{route('application.decision')}}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="action" value="accept">
                                        <input type="hidden" name="application_id" value="{{$application->id}}">
                                        <button href="" class="btn btn-primary mr-2" >Accept</button>
                                       </form>
                                       <form action="{{route('application.decision')}}"  method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="reject">
                                        <input type="hidden" name="application_id" value="{{$application->id}}">
                                        <button href="" class="btn btn-danger mr-2">Reject</button>

                                       </form>
                                
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection