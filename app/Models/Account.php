<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "amount",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, "account_id", "id");
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, "account_id", "id");
    }

}
