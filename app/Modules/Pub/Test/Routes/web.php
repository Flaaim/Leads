<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pub\Test\Controllers\TestController;

Route::group(['prefix'=> 'tests', 'middleware' => []], function(){
    Route::get('/', [TestController::class, 'index'])->name('tests.index');
    Route::get('/create', [TestController::class, 'create'])->name('tests.create');
    Route::post('/', [TestController::class, 'store'])->name('tests.create');
    Route::get('/edit/{test}', [TestController::class, 'edit'])->name('tests.edit');
    Route::put('/{test}', [TestController::class, 'update'])->name('tests.update');
    Route::delete('/{test}', [TestController::class, 'destroy'])->name('tests.destroy');
});