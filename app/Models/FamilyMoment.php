<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMoment extends Model
{
    use HasFactory;
    protected $table = 'family_moment';
    protected $fillable = [
        'name',
        'content',
        'created_by',
        'family_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function image()
    {
        return $this->hasMany(FamilyMomentImage::class, 'family_moment_id', 'id');
    }

}
