<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobFamily extends Model
{
    /*
    status
    */
    const DONOT      = 1; //chưa thực hiện
    const RECEIVED   = 2; //đã thực hiện
    const COMPLETE   = 3; //đã hoàn thành

    protected $table = 'job_family';

    protected $fillable = [
        'id',
        'family_id',
        'job_id',
        'status',
        'user_id',
        'image_1',
        'image_2',
        'image_3',
        'created_at',
        'updated_at',
    ];

    public function family(){
        return $this->belongsTo('App\Models\Family', 'family_id', 'id');
    }

    public function job(){
        return $this->belongsTo('App\Models\Job', 'job_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
