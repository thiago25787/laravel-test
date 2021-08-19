<?php

namespace App\Repositories;

use App\Exceptions\AppException;
use App\Models\Account;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepositRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DepositRepositoryEloquent extends BaseRepository implements DepositRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Deposit::class;
    }

    public function listByAccount(Account $account, $pagination = 10)
    {
        return $this->where("account_id", $account->id)
            ->orderBy("created_at", "desc")
            ->paginate($pagination);
    }

    public function listOutstanding($pagination = 10)
    {
        return $this->whereNull("approve")
            ->orderBy("created_at", "asc")
            ->with(['account', 'account.user'])
            ->paginate($pagination);
    }

    public function approve(Deposit $deposit, User $user)
    {
        if($this->verifyApprove($deposit)){
            throw new AppException(__("This deposit has been updated"));
        }
        $saved = false;
        DB::transaction(function() use($deposit, $user, &$saved){
            $deposit->fill([
                "approve" => true,
                "user_id_approved" => $user->id,
            ]);
            $deposit->save();
            $deposit->account->amount += $deposit->amount;
            $deposit->account->save();
            $saved = true;
        });
        return $saved;
    }
    public function deny(Deposit $deposit, User $user)
    {
        if($this->verifyApprove($deposit)){
            throw new AppException(__("This deposit has been updated"));
        }
        $deposit->fill([
            "approve" => false,
            "user_id_denied" => auth()->user()->id,
        ]);
        $denied = $deposit->save();
        return $denied;
    }

    private function verifyApprove(Deposit $deposit){
        $has_updated = false;
        if(is_bool($deposit->approve)){
            $has_updated = true;
        }
        return $has_updated;
    }

}
