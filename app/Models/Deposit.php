<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Deposit
 *
 * @property int $id
 * @property int $account_id
 * @property string $amount
 * @property string $image
 * @property bool|null $approve
 * @property int|null $user_id_approved
 * @property int|null $user_id_denied
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read mixed $image_path
 * @property-read mixed $status
 * @property-read \App\Models\User $userApproved
 * @property-read \App\Models\User $userDenied
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereApprove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUserIdApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deposit whereUserIdDenied($value)
 * @mixin \Eloquent
 */
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
