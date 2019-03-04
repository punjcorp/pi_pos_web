<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function show(){
        Log::info('The flow reached show method of Login');
        return View::make('login.login');
    }

    public function login(Request $request){
        Log::info('The flow reached login method of Login');
        return Redirect("/home");
    }

}
