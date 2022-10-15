<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $guarded=[ ' '];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function job(){
        return $this->belongsTo('App\Models\job');
    }
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','user_id');
    }
}
