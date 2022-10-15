@extends('admin.layouts.sidebar')

@section('content')
<span class="text">Dashboard</span>
</div>
<div class="container-fluid">
    <div class="header bg-gradient-primary pb-5 pt-5 px-5">
        <div class="header-body">
    <div class="row">
        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">
                    Total
                  </h5>
                  <span class="h2 font-weight-bold mb-0">350,897</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                    <i class="fas fa-chart-bar"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-success mr-2">
                  <i class="fa fa-arrow-up"></i> 3.48%
                </span>
                <span class="text-nowrap ms-2">Since last month</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">
                    Active
                  </h5>
                  <span class="h2 font-weight-bold mb-0">2,356</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                    <i class="fas fa-chart-pie"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-danger mr-2">
                  <i class="fas fa-arrow-down"></i> 3.48%
                </span>
                <span class="text-nowrap ms-2">Since last week</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">
                    Closed
                  </h5>
                  <span class="h2 font-weight-bold mb-0">49,65%</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="fas fa-percent"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-success mr-2">
                  <i class="fas fa-arrow-up"></i> 12%
                </span>
                <span class="text-nowrap ms-2">Since last month</span>
              </p>
            </div>
          </div>
        </div>
      </div>
</div>
    </div>
<div class="card mt-5 ">
    <div class="card-header mb-3">
        <h4 class="card-title float-left">Job Applications</h4>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>Applicant Name</th>
                    <th>Applicant Email</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                <tr>
                    <td>{{$application->id}}</td>
                    <td>{{$application->job->title}}</td>
                    
                    <td>{{$application->user->name}}</td>
                    <td>{{$application->user->email}}</td>
                    
                    <td class="d-flex">
                        <a href="" class="btn btn-primary mr-2">Accept</a>
                        <a href="" class="btn btn-danger mr-2">Reject</a>
                
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
@endsection
