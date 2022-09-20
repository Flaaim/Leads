<?php

namespace App\Modules\Admin\LeadComment\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\LeadComment\Requests\LeadCommentRequest;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\LeadComment\Service\LeadCommentService;

class LeadCommentController extends Controller {


    protected $service;

    public function __construct(LeadCommentService $service){
        $this->service = $service;
    }

    public function store(LeadCommentRequest $request){
        
        $this->authorize('store', LeadComment::class);
        $lead = $this->service->store($request, Auth::user());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'lead' => $lead,
        ]);
    }
}