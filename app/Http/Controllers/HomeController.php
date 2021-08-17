<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            return redirect()->route("account");
        }else{
            return redirect()->route("login");
        }
    }
}
