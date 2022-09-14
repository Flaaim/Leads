<?php

namespace App\Modules\Pub\Auth\Controllers;

use Illuminate\Http\Request;
use App\Modules\Pub\Auth\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Modules\Pub\Auth\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

    use AuthenticatesUsers;

    private $redirectTo = '/admin/dashboard';

    public function __consrtuct(){
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){

        return view('Pub::Auth.login');

    }


   
}