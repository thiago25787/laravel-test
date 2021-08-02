<?php

namespace App\Models;

use App\Exceptions\AppException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        "account_id",
        "description",
        "amount",
    ];

    public function account(){
        return $this->belongsTo(Account::class, "account_id", "id");
    }

    public function listByAccount(Account $account, $pagination = 10){
        return $this->where("account_id", $account->id)
            ->orderBy("created_at", "desc")
            ->paginate($pagination);
    }

    public function spend($amount, $description, Account $account){
        $saved = false;
        DB::transaction(function() use($amount, $description, $account, &$saved){
            if($amount > $account->amount){
                throw new AppException(__("You don't have money enough"));
            }
            $this->create([
                "amount" => $amount,
                "description" => $description,
                "account_id" => $account->id,
            ]);
            $account->amount -= $amount;
            $account->save();
            $saved = true;
        });
        return $saved;
    }

}
