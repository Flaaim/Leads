<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pub\Test\Controllers\TestController;

Route::group(['prefix' => 'tests', 'middleware' => []], function(){
    Route::get('/', [TestController::class, 'index'])->name('api.tests.index');
    Route::post('/', [TestController::class, 'store'])->name('api.tests.store');
    Route::get('/{test}', [TestController::class, 'show'])->name('api.tests.show');
    Route::put('/{test}', [TestController::class, 'update'])->name('api.tests.update');
    Route::delete('/{test}', [TestController::class, 'destroy'])->name('api.tests.destroy');
});