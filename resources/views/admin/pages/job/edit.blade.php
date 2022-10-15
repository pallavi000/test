@extends('admin.layouts.sidebar')

@section('content')

<span class="text">Job</span>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Update Job</h4>
                    <div class="float-right">
                        <a href="{{route('job.index')}}" class="btn btn-primary">Go Back</a>
                    </div>
                </div>
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

                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{route('job.update',$job->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            
                                    <label class="col-form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$job->title}}" required />
                              
                                    <div class="form-group">
                                    <label class="col-form-label">Description</label>
                                    <input type="text" class="form-control" name="description" value="{{$job->description}}" required />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Role</label>
                                    <input type="text" class="form-control" name="roles" value="{{$job->roles}}" required />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Duration</label>
                                    <input type="text" class="form-control" name="duration"  value="{{$job->duration}}" required />
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-form-label">Expire date</label>
                                    <input type="date" class="form-control" name="expire_date" value="{{$job->expire_date}}" required />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Requirement</label>
                                    <textarea type="text" class="form-control" name="requirements" value="{{$job->requirements}}" rows="4">{{$job->requirements}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Image</label>
                                    <div class="row d-flex">
                                    <input type="file" class="form-control" name="image" value="{{$job->image}}" />
                                    <img src="{{$job->image}}"  height="50"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection