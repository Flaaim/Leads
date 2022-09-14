<?php

namespace App\Modules\Admin\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Dashboard\Models\Dashboard;
use App\Modules\Admin\Dashboard\Classes\Base;

class DashboardController extends Base {

    public function index(){

        return view('Admin::Dashboard.dashboard');
    }
}