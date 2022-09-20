<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\LeadComment\Controllers\Api\LeadCommentController;

Route::group(['prefix' => 'lead_comments', 'middleware' => []], function(){
    Route::post('/', [LeadCommentController::class, 'store'])->name('api.lead_comments.store');
});