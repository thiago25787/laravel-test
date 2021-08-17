<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    private $repository;

    private $pagination = 10;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        Gate::authorize('user');
        $users = $this->repository->listAll($this->pagination);
        return view('user.index', [
            "users" => $users
        ]);
    }
}
