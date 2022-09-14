<?php

namespace App\Modules\Admin\Dashboard\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Base extends Controller 
{
    protected $template;
    protected $content;
    protected $vars;

    public function __construct(){
        $this->template = "layout";

        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function renderOutput(){
        return view($this->template)->with($this->vars);
    }
}