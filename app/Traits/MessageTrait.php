<?php

namespace App\Traits;

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
        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);
    }
}
