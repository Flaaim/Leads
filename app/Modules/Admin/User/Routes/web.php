<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\User\Controllers\UserController;

Route::group(['prefix'=> 'users', 'middleware' => []], function(){
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.create');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});