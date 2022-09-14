<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pub\Auth\Controllers\LoginController;

Route::group(['prefix' => 'auths', 'middleware' => []], function(){
    Route::get('/', [LoginController::class, 'index'])->name('api.auths.index');
});