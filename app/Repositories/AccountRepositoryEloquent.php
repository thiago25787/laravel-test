<?php

namespace App\Repositories;

use App\Exceptions\AppException;
use App\Models\Account;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AccountRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Account::class;
    }

    public function getByUser(User $user)
    {
        return $this->where("user_id", $user->id)->first();
    }

    public function save(User $user)
    {
        $account = $this->getByUser($user);
        if ($account) {
            throw new AppException("Account already created");
        }
        $created = $this->create([
            "user_id" => $user->id,
            "amount" => 0,
        ]);
        return $created;
    }

}
