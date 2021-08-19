<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Http\Requests\PurchaseRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Repositories\PurchaseRepository;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{

    private $repository;

    private $accountRepository;

    private $pagination = 10;

    public function __construct(PurchaseRepository $repository, AccountRepository $accountRepository)
    {
        $this->repository = $repository;
        $this->accountRepository = $accountRepository;
    }

    public function index()
    {
        Gate::authorize('account');
        $purchases = [];
        $account = $this->accountRepository->getByUser(auth()->user());
        if ($account) {
            $purchases = $this->repository->listByAccount($account, $this->pagination);
        } else {
            $this->error("You need to create an account first");
            redirect()->route("home");
        }
        return view('purchase.index', [
            "purchases" => $purchases,
            "account" => $account,
        ]);
    }

    public function create()
    {
        Gate::authorize('account');
        $account = $this->accountRepository->getByUser(auth()->user());
        if(!$account){
            $this->error("You need to create an account first");
            return redirect()->route("account");
        }
        return view('purchase.create', [
            "account" => $account,
        ]);
    }

    public function store(PurchaseRequest $request, Account $account)
    {
        Gate::authorize('account');
        $added = false;
        try {
            $added = $this->repository->spend($request->all(), $account);
            if ($added) {
                $msg = 'Purchase successfully';
            }
        } catch (AppException $e) {
            $msg = $e->getMessage();
        } catch (\Exception $e) {
            $msg = "Unable to buy";
        }
        if($added){
            $this->success($msg);
            return redirect()->route("purchase");
        }else{
            $this->error($msg);
            return redirect()->back()->withInput($request->input())->withErrors($request->getValidator()->errorsBag());
        }
    }
}
