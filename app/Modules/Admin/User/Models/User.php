<?php

namespace App\Modules\Admin\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Modules\Admin\Lead\Models\Traits\UserLead;
use Laravel\Passport\HasApiTokens;

class User extends AuthUser
{
    use HasFactory, UserLead, HasApiTokens;

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
