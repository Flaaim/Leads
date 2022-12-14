<?php

namespace App\Modules\Admin\Lead\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Unit\Models\Unit;
use App\Modules\Admin\Status\Models\Status;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\Source\Models\Source;

class Lead extends Model
{
    use HasFactory;

    const DONE_STATUS = 3;

    protected $fillable = [
        'phone',
        'link',
        'isQuality',
        'is_proccesed',
        'unit_id',
        'source_id',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }

    public function LeadComments(){
        return $this->hasMany(LeadComment::class);
    }

    public function statuses(){
        return $this->belongsToMany(Status::class);
    }

    public function getLeads(){
        return $this->with('unit', 'source', 'status')->whereBetween('status_id', [1,2])
            ->orWhere([
                ['status_id', 3],
                ['updated_at', '>', \DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)')],
            ])->orderBy('created_at')->get();
    }

    public function getArhiveLeads(){
        return $this->with('unit', 'source', 'status')->where([            
            ['status_id', self::DONE_STATUS], 
            ['updated_at', '>', \DB::raw('DATE_SUB(NOW(), INTERVAL 24 HOUR)')]
            ])->orderBy('id','desc')->paginate(config('settings.paginate'));
    }
}
