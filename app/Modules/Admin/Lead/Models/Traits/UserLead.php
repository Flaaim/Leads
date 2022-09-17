<?php

namespace App\Modules\Admin\Lead\Models\Traits;

trait UserLead {
    
    public function Lead(){
       return $this->hasMany(Lead::class); 
    }
}