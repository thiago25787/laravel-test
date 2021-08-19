<?php

namespace App\Repositories;

use App\Exceptions\AppException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function listAll($pagination = 10)
    {
        return $this->with(["account"])->orderBy("name")->paginate($pagination);
    }

    public function save(Array $data, User $user)
    {
        $user->fill([
            "name" => $data["name"],
            "email" => $data["email"],
        ]);
        if($data["new_password"]){
            $user->fill([
                "password" => Hash::make($data["new_password"]),
            ]);
        }
        $saved = $user->save();
        return $saved;
    }

}
