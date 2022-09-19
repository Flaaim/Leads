<?php 

namespace App\Modules\Admin\Lead\Service;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Status\Models\Status;

class Service {

    public function getLeads(){
        $leads = (new Lead())->getLeads();
        return $leads;
    }

    public function store($request, $user){
        $lead = new Lead();
        $lead->fill($request->only($lead->getFillable()));
        
        $status = Status::where('title', 'new')->first();
        $lead->status()->associate($status);
        $user->leads()->save($lead);
        $this->addStoreComments($lead, $request);
        return $lead;
        
    }
}