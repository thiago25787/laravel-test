<?php

namespace App\Http\Livewire\Account;

use App\Models\Account;
use App\Models\Deposit;
use App\Models\Purchase;
use App\Traits\GateTrait;
use App\Traits\MessageTrait;
use Livewire\Component;

class Balance extends Component
{

    use MessageTrait;
    use GateTrait;

    /**
     * @var Account
    */
    public $accountModel;

    /**
     * @var Deposit
    */
    public $depositModel;

    /**
     * @var Purchase
    */
    public $purchaseModel;

    public $creating = false;

    public function mount(Account $account, Deposit $deposit, Purchase $purchase)
    {
        $this->accountModel = $account;
        $this->depositModel = $deposit;
        $this->purchaseModel = $purchase;
    }

    public function render()
    {
        $this->deniedRedirect('account');
        $deposits = [];
        $purchases = [];
        $account = $this->accountModel->getByUser(auth()->user());
        if ($account) {
            $deposits = $this->depositModel->listByAccount($account);
            $purchases = $this->purchaseModel->listByAccount($account);
        }
        return view('livewire.account.balance', [
            "deposits" => $deposits,
            "purchases" => $purchases,
            "account" => $account,
        ]);
    }

    public function creating()
    {
        $this->creating = true;
    }

    public function create()
    {
        $created = false;
        if(!$this->accountModel->getByUser(auth()->user())){
            $created = $this->accountModel->create([
                "user_id" => auth()->user()->id,
                "amount" => 0,
            ]);
        }
        $this->message($created ? __('Account created successfully') : __("Unable to create new account"), $created ? 'success' : 'error');
        redirect()->route("dashboard");
    }
}
