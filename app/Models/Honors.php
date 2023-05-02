<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honors extends Model
{

    const TYPE_USER = 1;
    const TYPE_FAMILY = 2;

    protected $table = 'honors';

    protected $fillable = [
        'id',
        'criteria_id',
        'family_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function family(){
        return $this->belongsTo('App\Models\Family', 'family_id', 'id');
    }

    public function criteria(){
        return $this->belongsTo('App\Models\Criteria', 'criteria_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
