<?php

namespace App\Repositories;

use App\Models\Account;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PurchaseRepository.
 *
 * @package namespace App\Repositories;
 */
interface PurchaseRepository extends RepositoryInterface
{
    public function listByAccount(Account $account, $pagination = 10);

    public function spend(array $dados, Account $account);
}
