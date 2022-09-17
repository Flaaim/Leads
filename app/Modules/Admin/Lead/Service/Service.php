<?php 

namespace App\Modules\Admin\Lead\Service;

use App\Modules\Admin\Lead\Models\Lead;

class Service {

    public function getLeads(){
        $leads = (new Lead())->getLeads();
        return $leads;
    }
}