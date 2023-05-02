<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroduceFamily extends Model
{
    protected $table = 'introduce_family';

    protected $fillable = [
        'id',
        'description',
        'image',
        'detail',
        'family_id',
        'created_at',
        'updated_at',
    ];

    public function family(){
        return $this->belongsTo('App\Models\Family', 'family_id', 'id');
    }

}
