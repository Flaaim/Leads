<?php

namespace App\Modules\Admin\Lead\Models\Traits;

use App\Modules\Admin\Lead\Models\Lead;

trait UserLead {
    
    public function leads(){
       return $this->hasMany(Lead::class); 
    }
}