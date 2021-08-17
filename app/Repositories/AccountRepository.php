<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AccountRepository.
 *
 * @package namespace App\Repositories;
 */
interface AccountRepository extends RepositoryInterface
{
    public function getByUser(User $user);
}
