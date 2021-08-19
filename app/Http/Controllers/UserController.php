<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Http\Requests\UserRequest;
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

    public function show()
    {
        Gate::authorize('profile');
        $user = auth()->user();
        return view('user.show', [
            'user' => $user,
        ]);
    }

    public function store(UserRequest $request)
    {
        Gate::authorize('profile');
        $added = false;
        try {
            $user = auth()->user();
            $added = $this->repository->save($request->all(), $user);
            if ($added) {
                $msg = __('Profile updated');
            }
        } catch (AppException $e) {
            $msg = $e->getMessage();
        } catch (\Exception $e) {
            $msg = __("Unable to update");
        }
        if($added){
            $this->success($msg);
            return redirect()->route("user.profile");
        }else{
            $this->error($msg);
            return redirect()->back()->withInput($request->input())->withErrors($request->getValidator()->errorsBag());
        }
    }
}
