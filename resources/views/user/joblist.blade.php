@extends('layouts.app')
@section('content')
<div class="container p-4">
    <div class="d-flex justify-content-between align-items-center">
        <div class="row">
            <div class="col">
                <div class="category">All</div>
            </div>
            <div class="col">
                <div class="category">Jobs</div>
            </div>
            <div class="col">
                <div class="category active">Internship</div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="category-name">College Festivals</div>
            </div>
            <div class="col">
                <div class="category">Articles</div>
            </div>

        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 col-sm-12  filter-section">
            <div class="d-flex justify-content-between align-items-center">
                <div class="category-filter">Filters</div>
                <div class="category-reset-filter">Reset Filter</div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
                <div class="filter-status">Status</div>
                <div class="row">
                    <div class="col">
                        <div class="category">All</div>
                    </div>
                    <div class="col">
                        <div class="category">Live</div>
                    </div>
                    <div class="col">
                        <div class="category">Expired</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row justify-content-between align-items-center">
                <div class="filter-status">Payment</div>
                <div class="row">
                    <div class="col">
                        <div class="category">All</div>
                    </div>
                    <div class="col">
                        <div class="category">Paid</div>
                    </div>
                    <div class="col">
                        <div class="category">Free</div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="filter-status">Eligibility</div>
            <div class="row">
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            All
                        </label>
                    </div>
                </div>
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Professional
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Startups
                        </label>
                    </div>
                </div>
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            School Students
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            College Students
                        </label>
                    </div>
                </div>
            </div>
            <hr>

            <div class="filter-status">Category</div>
            <div class="form-group">
                <input type="text" class=" search-filter">
            </div>
            <div class="row">
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Accounts
                        </label>
                    </div>
                </div>
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Acting
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Advertising
                        </label>
                    </div>
                </div>
                <div class="col ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Animation
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-more">
                <label class="form-check-label form-more-label" for="flexCheckDefault">
                    more
                </label>
            </div>
            <hr>

        </div>
        <div class="col-md-6 col-sm-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="trending-btn">Trending</div>
                <div class="trending-sort">Sort By :</div>
            </div>
            @foreach($jobs as $job)
            <a href="{{route('job.detail',$job->id)}}" class="d-flex justify-content-between trending-wrapper @if($job->status=='active') border-success @endif">
                
                <div class="trending-img">
                    <img src="{{$job->image}}" class="img-fluid">
                </div>
                <div>
                    <div class="trending-title">{{$job->title}}</div>
                    <div class="trending-sub">{{$job->company->name}}</div>
                    <div class="d-flex mb-3">
                        <img src="./image/puzz.png">
                        <div class="trending-count">{{$job->application_count}} Applied</div>
                    </div>
                    <div class="d-flex">
                        <div class="trending-success">{{$job->duration}}</div>
                        <div class="trending-error">{{$job->roles}}</div>
                    </div>
                </div>
                <div>
                    @if($job->status=="active")
                    <div class="active-btn">Open</div>

                    @else

                    <div class="close-btn">Close</div>
                    
                    @endif
                </div>

            </a>
            @endforeach
            <div class="d-flex justify-content-between">
                <div>
                    Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries
                </div>
                <div>
                    {!! $jobs->links() !!}
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>


</div>
@endsection