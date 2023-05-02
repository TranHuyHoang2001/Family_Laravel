<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'role_id',
        'created_by',
    ];

    public function memberFamily()
    {
        return $this->belongsToMany(User::class, 'member_family', 'family_id', 'user_id');
    }

    public function member()
    {
        return $this->hasMany(MemberFamily::class, 'family_id', 'id');
    }

    public function jobFamily()
    {
        return $this->belongsToMany(Job::class, 'job_family', 'family_id', 'job_id');
    }

    public function job()
    {
        return $this->hasMany(JobFamily::class, 'family_id', 'id');
    }
}
