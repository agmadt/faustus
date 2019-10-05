<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->get([
            'pagination' => 10,
            'with' => ['profile'],
        ]);

        $data = [
            'users' => $users,
        ];

        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'user' => (new User)->load('profile'),
        ];

        return view('user.create', $data);
    }

    public function store(UserStoreRequest $request)
    {
        $this->userRepository->store($request);
        return redirect()->route('user.index')
            ->with('success', 'User successfully created.');
    }

    public function edit(User $user)
    {
        $data = [
            'user' => $user->load('profile'),
        ];

        return view('user.edit', $data);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);
        return redirect()->route('user.index')->with('success', 'User successfully updated.');
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user);
        return redirect()->route('user.index')->with('success', 'User successfully deleted.');
    }
}
