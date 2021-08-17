<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Deposit;
use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DepositRepository.
 *
 * @package namespace App\Repositories;
 */
interface DepositRepository extends RepositoryInterface
{
    public function listByAccount(Account $account, $pagination = 10);

    public function listOutstanding($pagination = 10);

    public function approve(Deposit $deposit, User $user);

    public function deny(Deposit $deposit, User $user);
}
