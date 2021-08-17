<?php

namespace App\Repositories;

use App\Exceptions\AppException;
use App\Models\Account;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PurchaseRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PurchaseRepositoryEloquent extends BaseRepository implements PurchaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Purchase::class;
    }

    public function listByAccount(Account $account, $pagination = 10)
    {
        return $this->where("account_id", $account->id)
            ->orderBy("created_at", "desc")
            ->paginate($pagination);
    }

    public function spend(array $dados, Account $account)
    {
        $saved = false;
        DB::transaction(function() use($dados, $account, &$saved){
            if($dados["amount"] > $account->amount){
                throw new AppException(__("You don't have money enough ($account->amount)"));
            }
            $this->create([
                "amount" => $dados["amount"],
                "description" => $dados["description"],
                "account_id" => $account->id,
            ]);
            $account->amount -= $dados["amount"];
            $account->save();
            $saved = true;
        });
        return $saved;
    }
}
