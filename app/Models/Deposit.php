<?php
namespace App\Models;

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
        "user_id_approved",
        "user_id_denied",
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
            $image_path = asset('/storage/' . $this->image);
        }
        return $image_path;
    }

    public function userApproved()
    {
        return $this->belongsTo(User::class, "user_approve_id", "id");
    }

    public function userDenied()
    {
        return $this->belongsTo(User::class, "user_deny_id", "id");
    }

    public function account()
    {
        return $this->belongsTo(Account::class, "account_id", "id");
    }

}
