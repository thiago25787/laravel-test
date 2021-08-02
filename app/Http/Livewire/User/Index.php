<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Traits\GateTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use GateTrait;

    public $userModel;

    public $pagination = 10;

    public function mount(User $user)
    {
        $this->userModel = $user;
    }

    public function render()
    {
        $this->deniedRedirect('user');
        $users = $this->userModel->paginate($this->pagination);
        return view('livewire.user.index', [
            "users" => $users
        ]);
    }
}
