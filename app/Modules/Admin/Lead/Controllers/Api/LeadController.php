<?php

namespace App\Modules\Admin\Lead\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Service\Service;
use App\Modules\Admin\Status\Models\Status;
use App\Services\Response\ResponseService;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use Illuminate\Support\Facades\Auth;


class LeadController extends Controller {


    protected $service;

    public function __construct(Service $service){
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $this->authorize('view', Lead::class);
        $leads = $this->service->getLeads();
        $statuses = Status::all();
        $resultLeads = [];
        $statuses->each(function($item, $key)use(&$resultLeads, $leads){
            $collection = $leads->where('status_id', $item->id);
            $resultLeads[$item->title] = $collection;
            
        });

        return ResponseService::sendJsonResponse(true, 200, [], [
            'items' => $resultLeads,
        ]);

    }

    public function store(LeadCreateRequest $request){
        
        $this->authorize('create', Lead::class);
        
        $lead = $this->service->store($request, Auth::user());

        return ResponseService::sendJsonResponse(true, 200, [], [
            'item' => $lead,
        ]);
    }

}