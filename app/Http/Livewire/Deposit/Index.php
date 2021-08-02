<?php

namespace App\Http\Livewire\Deposit;

use App\Models\Account;
use App\Models\Deposit;
use App\Traits\GateTrait;
use App\Traits\MessageTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use WithFileUploads;
    use MessageTrait;
    use GateTrait;

    /**
     * @var Account
    */
    public $accountModel;

    /**
     * @var Account
     */
    public $account;

    /**
     * @var Deposit
     */
    public $depositModel;

    public $adding = false;

    private $pagination = 10;

    public $amount;

    public $image;

    public $canBeSubmitted = false;

    public $rules = [
        'amount' => 'required|numeric',
        'image' => 'required|image|mimes:jpg,jpeg,png',
    ];

    public function mount(Account $account, Deposit $deposit)
    {
        $this->accountModel = $account;
        $this->depositModel = $deposit;
    }

    public function updatedImage($value)
    {
        $this->canBeSubmitted = $value ? true : false;
    }

    public function render()
    {
        $this->deniedRedirect('account');
        $deposits = [];
        $this->account = $this->accountModel->getByUser(auth()->user());
        if ($this->account) {
            $deposits = $this->depositModel->listByAccount($this->account, $this->pagination);
        } else {
            $this->error(__("You need to create an account first"));
            redirect()->route("dashboard");
        }
        return view('livewire.deposit.index', [
            "deposits" => $deposits,
        ]);
    }

    public function adding()
    {
        $this->reset(["image", "amount"]);
        $this->adding = true;
    }

    public function add()
    {
        if($this->canBeSubmitted) {
            $this->validate();
            $image_url = $this->image->store('deposits', 'public');
            $added = $this->depositModel->create([
                "account_id" => $this->account->id,
                "amount" => $this->amount,
                "image" => $image_url,
                "approved" => null,
            ]);
            $this->message($added ? __('Amount requested successfully') : __("Unable to add amount"), $added ? 'success' : 'error');
            redirect()->to("deposit");
        }
    }
}
