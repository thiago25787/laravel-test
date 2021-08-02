<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        if(Auth::check()){
            $this->redirectRoute("dashboard");
        }
        return view('livewire.auth.login')->layout("auth.login");
    }
}
