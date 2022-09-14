<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pub\Auth\Controllers\LoginController;

Route::group(['prefix'=> '', 'middleware' => []], function(){
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('auths.index');
    Route::post('/', [LoginController::class, 'login'])->name('auths.login');
});