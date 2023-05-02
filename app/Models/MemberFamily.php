<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberFamily extends Model
{
    use HasFactory;
    protected $table = 'member_family';
    protected $fillable = [
        'family_id',
        'user_id',
        'role_id',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id','family_id');
    }

    public function getStatus()
    {
        switch ($this->status)
        {
            case 1:
                return '<a class="btn btn-success btn-register">Chưa duyệt</a>';
            case 2:
                return '<a class="btn btn-success btn-register">Đã duyệt</a>';
        }
    }
}
