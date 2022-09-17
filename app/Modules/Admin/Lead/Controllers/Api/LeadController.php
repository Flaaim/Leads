<?php

namespace App\Modules\Admin\Lead\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Service\Service;
use App\Modules\Admin\Status\Models\Status;
use App\Services\Response\ResponseService;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}