@extends('admin.layouts.sidebar')

@section('content')

<span class="text">Job</span>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Expired Job List</h4>
                   
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
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Requirements</th>
                                    <th>Role</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{{$job->title}}</td>
                                    <td>
                                        <img src="{{$job->image}}" class="img-fluid" width="50"></td>
                                    <td>{{$job->description}}</td>
                                    <td>{{$job->requirements}}</td>
                                    <td>{{$job->roles}}</td>
                                    <td>{{$job->duration}}</td>
                                    <td>{{$job->status}}</td>
                                    <td>{{$job->expire_date}}</td>
                                    <td class="d-flex">
                                        
                                        <a href="{{route('job.show',$job->id)}}" class="btn btn-info mr-2">Show</a>
                                        <form method="POST" action="{{route('job.destroy',$job->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>

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