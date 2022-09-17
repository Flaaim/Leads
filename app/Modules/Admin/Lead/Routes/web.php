<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Lead\Controllers\LeadController;

Route::group(['prefix'=> 'leads', 'middleware' => []], function(){
    Route::get('/', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/', [LeadController::class, 'store'])->name('leads.create');
    Route::get('/edit/{lead}', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');
});