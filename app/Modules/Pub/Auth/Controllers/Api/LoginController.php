<?php

namespace App\Modules\Pub\Auth\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Pub\Auth\Models\User;
use App\Modules\Pub\Auth\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Response\ResponseService;
use Carbon\Carbon;

class LoginController extends Controller {

    public function login(LoginRequest $request){
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return ResponseService::sendJsonResponse(false, 403, 
            ['Ошибка']);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        return ResponseService::sendJsonResponse(true, 200, [], [
            'api_token' => $tokenResult->accessToken,
            'user' => $user,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ]);
    }
}