<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Http\Requests\AccountRequest;
use App\Repositories\AccountRepository;
use App\Repositories\DepositRepository;
use App\Repositories\PurchaseRepository;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{

    private $repository;

    private $depositRepository;

    private $purchaseRepository;

    public function __construct(AccountRepository $repository, DepositRepository $depositRepository, PurchaseRepository $purchaseRepository)
    {
        $this->repository = $repository;
        $this->depositRepository = $depositRepository;
        $this->purchaseRepository = $purchaseRepository;
    }

    public function index()
    {
        Gate::authorize('account');
        $deposits = [];
        $purchases = [];
        $account = $this->repository->getByUser(auth()->user());
        if ($account) {
            $deposits = $this->depositRepository->listByAccount($account);
            $purchases = $this->purchaseRepository->listByAccount($account);
        }
        return view('account.index', [
            "deposits" => $deposits,
            "purchases" => $purchases,
            "account" => $account,
        ]);
    }

    public function store(AccountRequest $request)
    {
        Gate::authorize('account');
        try {
            $created = $this->repository->save(auth()->user());
            if($created){
                $msg = __('Account created successfully');
            }
        } catch (AppException $e) {
            $msg = $e->getMessage();
        } catch (\Exception $e) {
            $msg = "Unable to create new account";
        }
        $this->message($msg ?? null, $created ? 'success' : 'error');
        return redirect()->route("account");
    }
}
