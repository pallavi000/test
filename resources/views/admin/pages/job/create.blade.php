@extends('admin.layouts.sidebar')

@section('content')

<span class="text">Job</span>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Add New Job</h4>
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
                    <form method="POST" action="{{route('job.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            
                                    <label class="col-form-label">Title</label>
                                    <input type="text" class="form-control" name="title" required />
                              
                                    <div class="form-group">
                                    <label class="col-form-label">Description</label>
                                    <input type="text" class="form-control" name="description" required />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Role</label>
                                    <input type="text" class="form-control" name="roles" required />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Duration</label>
                                    <input type="text" class="form-control" name="duration" required />
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-form-label">Expire date</label>
                                    <input type="date" class="form-control" name="expire_date" required />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Requirement</label>
                                    <textarea type="text" class="form-control" name="requirements" required rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Image</label>
                                    <input type="file" class="form-control" name="image" required />
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