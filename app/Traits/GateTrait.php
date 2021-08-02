<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait GateTrait
{

    use MessageTrait;

    public function deniedRedirect($module, $sendMessage = true){
        if($this->denied($module)) {
            if($sendMessage) {
                $this->error(__("Access denied"));
            }
            redirect()->route("dashboard");
        }
    }

    public function denied($module){
        return Gate::denies($module, auth()->user());
    }
}
