<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Models\Deposit;
use App\Repositories\AccountRepository;
use App\Repositories\DepositRepository;
use Illuminate\Support\Facades\Gate;

class ApproveController extends Controller
{
    private $pagination = 10;

    private $repository;

    private $accountRepository;

    public function __construct(DepositRepository $depositRepository, AccountRepository $accountRepository)
    {
        $this->repository = $depositRepository;
        $this->accountRepository = $accountRepository;
    }

    public function index()
    {
        Gate::authorize('approve');
        $deposits = $this->repository->listOutstanding($this->pagination);
        return view('approve.index', [
            "deposits" => $deposits
        ]);
    }

    public function store(Deposit $deposit)
    {
        Gate::authorize('approve');
        try {
            $this->repository->approve($deposit, auth()->user());
            $this->success(__("Deposit approved successfully"));
        }catch(AppException $e){
            $this->error($e->getMessage());
        }catch(\Exception $e){
            $this->error("Processing error");
        }
        return redirect()->route("deposit.approve");
    }

    public function destroy(Deposit $deposit)
    {
        Gate::authorize('approve');
        try {
            $this->repository->deny($deposit, auth()->user());
            $this->success(__("Deposit deny successfully"));
        }catch(AppException $e){
            $this->error($e->getMessage());
        }catch(\Exception $e){
            $this->error("Processing error");
        }
        return redirect()->route("deposit.approve");
    }

}
