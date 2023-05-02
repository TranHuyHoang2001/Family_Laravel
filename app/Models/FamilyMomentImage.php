<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMomentImage extends Model
{
    use HasFactory;
    protected $table = 'family_moment_image';
    protected $fillable = [
        'family_moment_id',
        'image'
    ];
}
