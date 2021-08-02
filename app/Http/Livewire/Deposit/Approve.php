<?php

namespace App\Http\Livewire\Deposit;

use App\Exceptions\AppException;
use App\Models\Deposit;
use App\Traits\GateTrait;
use App\Traits\MessageTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Approve extends Component
{

    use MessageTrait;
    use GateTrait;
    use WithPagination;

    /**
     * @var Deposit
     */
    public $depositModel;

    /**
     * @var Deposit
     */
    public $deposit;

    public $modal = false;

    public $modalImage = false;

    public $image;

    private $pagination = 10;

    public function mount(Deposit $depositModel)
    {
        $this->depositModel = $depositModel;
    }

    public function render()
    {
        $this->deniedRedirect('approve');
        $deposits = $this->depositModel->listOutstanding($this->pagination);
        return view('livewire.deposit.approve', [
            "deposits" => $deposits
        ]);
    }

    public function modal(Deposit $deposit)
    {
        $this->deposit = $deposit;
        $this->modal = true;
    }

    public function modalImage(Deposit $deposit)
    {
        $this->image = $deposit->image_path;
        $this->modalImage = true;
    }

    public function approve()
    {
        try {
            $this->depositModel->approve($this->deposit, auth()->user());
        }catch(AppException $e){
            $this->error($e->getMessage());
        }
        $this->modal = false;
        $this->success(__("Deposit approved successfully"));
        redirect()->route("deposit.approve");
    }

    public function deny()
    {
        $this->deposit->fill([
            "approve" => false,
            "user_id_denied" => auth()->user()->id,
        ]);
        $this->deposit->save();
        $this->success(__("Deposit deny successfully"));
        redirect()->route("deposit.approve");
    }

}
