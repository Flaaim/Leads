<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Source\Controllers\Api\SourceController;

Route::group(['prefix' => 'sources', 'middleware' => []], function(){
    Route::get('/', [SourceController::class, 'index'])->name('api.sources.index');
    Route::post('/', [SourceController::class, 'store'])->name('api.sources.store');
    Route::get('/{source}', [SourceController::class, 'show'])->name('api.sources.show');
    Route::put('/{source}', [SourceController::class, 'update'])->name('api.sources.update');
    Route::delete('/{source}', [SourceController::class, 'destroy'])->name('api.sources.destroy');
});