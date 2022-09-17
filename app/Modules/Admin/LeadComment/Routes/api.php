<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\LeadComment\Controllers\Api\LeadCommentController;

Route::group(['prefix' => 'lead_comments', 'middleware' => []], function(){
    Route::get('/', [LeadCommentController::class, 'index'])->name('api.lead_comments.index');
    Route::post('/', [LeadCommentController::class, 'store'])->name('api.lead_comments.store');
    Route::get('/{lead_comment}', [LeadCommentController::class, 'show'])->name('api.lead_comments.show');
    Route::put('/{lead_comment}', [LeadCommentController::class, 'update'])->name('api.lead_comments.update');
    Route::delete('/{lead_comment}', [LeadCommentController::class, 'destroy'])->name('api.lead_comments.destroy');
});