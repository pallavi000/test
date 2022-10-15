<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\job;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrap();

        $date = Carbon::now();
        $jobs = job::where('expire_date','<',$date)->where('status','active')->get();
        foreach ($jobs as $job) {
          $job->status = 'expired';
          $job->save();
        }

    }
}
