<?php 

namespace App\Modules\Admin\LeadComment\Service;

class LeadCommentService {
    public static function saveComment(string $text, Lead $lead, User $user, Status $status, string $commentValue, bool $is_event) {
        
        $comment = new LeadComment([
            'text' => $text,
            'commentValue' => $commentValue,
        ]);
        $comment->is_event = $is_event,
        $comment->lead()->associate($status)->user()->associate($user)->status()->associate($status)->save();

        return $leadComment;
    }
}