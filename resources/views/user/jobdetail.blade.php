@extends('layouts.app')
@section('content')
<div class="container p-4">
   <div class="card">
    <div class="card-header">Job Detail</div>
    <div class="card-body">
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
            @if($applied)
            <div class="alert alert-info mt-4">You have already applied for this job .</div>

            @else

            <form method="POST" action="{{route('job-application.store')}}">
                @csrf
                <input type="hidden" name="job_id" value="{{$job->id}}"/>
                <input type="hidden" name="company_id" value="{{$job->company_id}}"/> 
        <button class="btn btn-primary btn-lg mx-auto mt-5 text-center">Apply</button>
            </form>
            @endif
    </div>
   </div>

</div>
@endsection