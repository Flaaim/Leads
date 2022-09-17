<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pub\Auth\Controllers\Api\LoginController;

Route::group(['prefix' => '', 'middleware' => []], function(){
    Route::post('/', [LoginController::class, 'login'])->name('api.auths.index');
});