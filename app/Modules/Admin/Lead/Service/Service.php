<?php 

namespace App\Modules\Admin\Lead\Service;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Status\Models\Status;
use App\modules\Admin\LeadComment\Service\LeadCommentService;

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
        $lead->statuses()->attach($status->id);
        $this->addStoreComments($lead, $request, $user, $status);
        return $lead;
        
    }


    public function addStoreComments($lead, $request, $user, $status){
        
        $is_event = true;
        $tmpText = "Автор ".$user->firstname." создал новый лид со статусом ".$status->title;
        LeadCommentService::saveComment($tmpText, $lead, $user, $status, null, $is_event);
        
        if($request->text){
            $tmpText = "Пользователь ".$user->firstname." оставил комментарий ".$request->text;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text);
        }
    }
}