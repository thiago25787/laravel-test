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

    public function account()
    {
        return $this->belongsTo(Account::class, "account_id", "id");
    }

}
