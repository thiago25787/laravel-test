<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Http\Requests\DepositRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Repositories\DepositRepository;
use Illuminate\Support\Facades\Gate;

class DepositController extends Controller
{
    private $repository;

    private $accountRepository;

    private $pagination = 10;

    public function __construct(DepositRepository $depositRepository, AccountRepository $accountRepository)
    {
        $this->repository = $depositRepository;
        $this->accountRepository = $accountRepository;
    }

    public function index()
    {
        Gate::authorize('account');
        $deposits = [];
        $account = $this->accountRepository->getByUser(auth()->user());
        if ($account) {
            $deposits = $this->repository->listByAccount($account, $this->pagination);
        } else {
            $this->error(__("You need to create an account first"));
            redirect()->route("account");
        }
        return view('deposit.index', [
            "account" => $account,
            "deposits" => $deposits,
        ]);
    }

    public function create()
    {
        Gate::authorize('account');
        $account = $this->accountRepository->getByUser(auth()->user());
        if(!$account){
            $this->error(__("You need to create an account first"));
            return redirect()->route("account");
        }
        return view('deposit.create', [
            "account" => $account,
        ]);
    }

    public function store(DepositRequest $request, Account $account)
    {
        Gate::authorize('account');
        $added = false;
        try {
            $image_url = $request->file("image")->store('deposits', 'public');
            $added = $this->repository->create([
                "account_id" => $account->id,
                "amount" => $request->get("amount"),
                "image" => $image_url,
                "approved" => null,
            ]);
            if($added){
                $msg = __('Amount requested successfully');
            }
        } catch (AppException $e) {
            $msg = $e->getMessage();
        } catch (\Exception $e) {
            dd($e);
            $msg = __("Unable to add amount");
        }
        if($added){
            $this->success($msg);
            return redirect()->route("deposit");
        }else{
            $this->error($msg);
            return redirect()->back()->withInput($request->input())->withErrors($request->getValidator()->errorsBag());
        }
    }
}
