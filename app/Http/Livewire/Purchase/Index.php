<?php

namespace App\Http\Livewire\Purchase;

use App\Exceptions\AppException;
use App\Models\Account;
use App\Models\Purchase;
use App\Traits\GateTrait;
use App\Traits\MessageTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use MessageTrait;
    use GateTrait;

    /**
     * @var Account
     */
    public $accountModel;

    /**
     * @var Purchase
     */
    public $purchaseModel;

    /**
     * @var Account
     */
    public $account;

    private $pagination = 10;

    public $description;

    public $amount;

    public $adding = false;

    public $rules = [
        'amount' => 'required|numeric',
        'description' => 'required|max:255',
    ];

    public function mount(Account $account, Purchase $purchase)
    {
        $this->accountModel = $account;
        $this->purchaseModel = $purchase;
    }

    public function render()
    {
        $this->deniedRedirect('account');
        $purchases = [];
        $this->account = $this->accountModel->getByUser(auth()->user());
        if ($this->account) {
            $purchases = $this->purchaseModel->listByAccount($this->account, $this->pagination);
        } else {
            $this->error(__("You need to create an account first"));
            redirect()->route("dashboard");
        }
        return view('livewire.purchase.index', [
            "purchases" => $purchases,
        ]);
    }

    public function adding()
    {
        $this->reset(["amount", "description"]);
        $this->adding = true;
    }

    public function add()
    {
        $this->validate();
        try {
            $added = $this->purchaseModel->spend($this->amount, $this->description, $this->account);
            $this->message($added ? __('Purchase successfully') : __("Unable to buy"), $added ? 'success' : 'error');
        }catch(AppException $e){
            $this->error($e->getMessage());
        }
        redirect()->to("purchase");
    }
}
