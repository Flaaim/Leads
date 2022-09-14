<?php

namespace App\Modules\Admin\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
