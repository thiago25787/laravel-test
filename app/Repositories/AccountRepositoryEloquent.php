<?php

namespace App\Repositories;

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

}
