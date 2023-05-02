<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    const HIGHLIGHTS = 1;
    const NOTHIGHLIGHTS = 0;

    protected $fillable = [
        'id',
        'name',
        'point',
        'image',
        'role_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by'
    ];

    public function userCreated(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function userUpdated(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

}
