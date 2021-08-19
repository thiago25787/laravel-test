<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function listAll($pagination = 10);

    public function save(Array $data, User $user);
}
