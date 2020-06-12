<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ProjectManagerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if((auth()->user()->role == 1) || (auth()->user()->role == 4)){
                return $next($request);
            }else{
                return Redirect::back();
            }
        });
    }
}
