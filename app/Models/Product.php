<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'image',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function userCreated(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function userUpdated(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

}
