<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Lead\Controllers\Api\LeadController;

Route::group(['prefix' => 'leads', 'middleware' => []], function(){
    Route::get('/', [LeadController::class, 'index'])->name('api.leads.index');
    Route::post('/', [LeadController::class, 'store'])->name('api.leads.store');
    Route::get('/{lead}', [LeadController::class, 'show'])->name('api.leads.show');
    Route::put('/{lead}', [LeadController::class, 'update'])->name('api.leads.update');
    Route::delete('/{lead}', [LeadController::class, 'destroy'])->name('api.leads.destroy');
});