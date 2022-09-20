<?php 

namespace App\Modules\Admin\LeadComment\Service;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\LeadComment\Models\LeadComment;

class LeadCommentService {



    public static function saveComment(string $text, Lead $lead, User $user, Status $status, string $commentValue = null, bool $is_event = false) {
        
        $comment = new LeadComment([
            'text' => $text,
            'commentValue' => $commentValue,
        ]);
        $comment->is_event = $is_event;
        $comment->lead()->associate($lead)->user()
            ->associate($user)->status()
                ->associate($status)->save();

        return $comment;
    }

    public function store($request, $user){

        $lead = Lead::findOrFail($request->lead_id);
        $status = Status::findOrFail($request->status_id);
        
        
        if($status->id != $lead->status->id){
            $is_event = true;
            $tmpText = "Пользователь ".$user->firstname." изменил статус лида на ".$status->title;
            self::saveComment($tmpText, $lead, $user, $status, null, $is_event);
            $lead->status()->associate($status)->save();
            $lead->statuses()->attach($status->id);
        }
        
        if($request->user_id && $request->user_id != $lead->user->id){
            $is_event = true;
            $newUser = User::findOrFail($request->user_id);
            
            $tmpText = "Пользователь ".$user->firstname." изменил автора лида на ".$newUser->firstname;
            self::saveComment($tmpText, $lead, $newUser, $status, null, $is_event);
            $lead->user()->associate($newUser)->save();
        }
        if($request->text){
            $is_event = false;
            $tmpText = "Пользователь ".$user->firstname." оставил комментарий ".$request->text;
            self::saveComment($tmpText, $lead, $user, $status, $request->text);
        }
        return $lead;
    }
}