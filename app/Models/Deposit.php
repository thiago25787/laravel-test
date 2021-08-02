<?php

namespace App\Models;

use App\Exceptions\AppException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        "account_id",
        "amount",
        "image",
        "approve",
        "user_approve_id",
        "user_deny_id",
    ];

    protected $casts = [
        "approve" => "boolean",
    ];

    protected $appends = [
        "status",
        "image_path"
    ];

    public function getStatusAttribute()
    {
        $status = null;
        if(is_bool($this->approve)){
            $status = $this->approve ? __("Yes") : __("No");
        }else{
            $status = __("Not yet");
        }
        return $status;
    }
    public function getImagePathAttribute()
    {
        $image_path = null;
        if($this->image){
           $image_path = '/storage/' . $this->image;
        }
        return $image_path;
    }

    public function userApproved(){
        return $this->belongsTo(User::class, "user_approve_id", "id");
    }

    public function userDenied(){
        return $this->belongsTo(User::class, "user_deny_id", "id");
    }

    public function account(){
        return $this->belongsTo(Account::class, "account_id", "id");
    }

    public function listByAccount(Account $account, $pagination = 10){
        return $this->where("account_id", $account->id)
            ->orderBy("created_at", "desc")
            ->paginate($pagination);
    }

    public function listOutstanding($pagination = 10){
        return $this->whereNull("approve")
            ->orderBy("created_at", "asc")
            ->with(['account', 'account.user'])
            ->paginate($pagination);
    }

    public function approve(Deposit $deposit, User $user){
        $saved = false;
        DB::transaction(function() use($deposit, $user, &$saved){
            $deposit->fill([
                "approve" => true,
                "user_id_approve" => $user->id,
            ]);
            $deposit->save();
            $deposit->account->amount += $deposit->amount;
            $deposit->account->save();
            $saved = true;
        });
        return $saved;
    }
}
