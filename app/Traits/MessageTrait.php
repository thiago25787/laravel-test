<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait MessageTrait
{
    public function success($message){
        $this->message($message, 'success');
    }

    public function info($message){
        $this->message($message, 'info');
    }

    public function warning($message){
        $this->message($message, 'warning');
    }

    public function error($message){
        $this->message($message, 'danger');
    }

    public function message($message, $type = 'success'){
        if($type == "error"){
            $type = "danger";
        }
        Session::flash($type, $message);
    }
}
