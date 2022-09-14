<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Dashboard\Controllers\DashboardController;

Route::group(['prefix'=> 'dashboard', 'middleware' => []], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboards.index');
    Route::get('/create', [DashboardController::class, 'create'])->name('dashboards.create');
    Route::post('/', [DashboardController::class, 'store'])->name('dashboards.create');
    Route::get('/edit/{dashboard}', [DashboardController::class, 'edit'])->name('dashboards.edit');
    Route::put('/{dashboard}', [DashboardController::class, 'update'])->name('dashboards.update');
    Route::delete('/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboards.destroy');
});