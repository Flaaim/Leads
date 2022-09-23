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

    public function update($request, $lead, $user){
        $tmp = clone $lead;
        $lead->countable++;
        $status = Status::where('title', 'new')->first();
        $lead->status()->associate($status);
        $lead->fill($request->only($lead->getFillable()));
        
        $lead->save();
        $this->addUpdateComments($request, $lead, $tmp, $status, $user);
        return $lead;
    }

    public function addUpdateComments($request, $lead, $tmp, $status, $user){
        

        if($request->text){
            $tmpText = "Пользователь ".$user->firstname." оставил комментарий к лиду ".$request->text;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, $request->text, $is_event);
        }
        if($tmp->unit_id != $lead->unit_id){
            $is_event = true;
            $tmpText = "Пользователь ".$user->firstname." изменил подразделение лида на ".$lead->unit->title;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, null, $is_event);
        }
        if($tmp->source_id != $lead->source_id){
            $is_event = true;
            $tmpText = "Пользователь ".$user->firstname." изменил источник лида на ".$lead->source->title;
            LeadCommentService::saveComment($tmpText, $lead, $user, $status, null, $is_event);
        }
        $is_event = true;
        $tmpText = "Пользователь ".$user->firstname." создал лид со статусом ".$status->title;
        LeadCommentService::saveComment($tmpText, $lead, $user, $status, null, $is_event);
        $lead->statuses()->attach($status->id);
    }

    public function arhive(){
        $leads = (new Lead)->getArhiveLeads();
        
        return $leads;
    }



    public function checkExists($request){
        $queryBuilder = Lead::select('*');

        if($request->link){
            $queryBuilder->where('link', $request->link);
        } 
        elseif($request->phone){
            $queryBuilder->where('phone', $request->phone);
        }
        return $queryBuilder->where('status_id', Lead::DONE_STATUS)->first();

    }
}