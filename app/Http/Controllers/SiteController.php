<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Violation;

class SiteController extends Controller
{

    // Home
    public function dashboard(){
        if(!Auth::check()) return view('site/home');  // User is not logged in
        else return redirect()->action('UserController@show',[Auth::user()->id]);
    }
   
}
