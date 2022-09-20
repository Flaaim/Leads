<?php

namespace App\Modules\Admin\LeadComment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\Lead\Models\Lead;


class LeadComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'commentValue',
    ];

    public function lead(){
        return $this->belongsTo(Lead::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
