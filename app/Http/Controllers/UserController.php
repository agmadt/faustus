<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Processor\ProcessUpload;
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
        $page = request()->page ?? 1;
        $pagination = 10;
        $users = $this->userRepository->get([
            'pagination' => $pagination,
            'with' => ['profile'],
        ]);

        $data = [
            'no' => ($page - 1) * $pagination,
            'users' => $users,
        ];

        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'user' => new User,
        ];

        return view('user.create', $data);
    }

    public function store(UserStoreRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file')->get();
            new ProcessUpload($file);
        }

        request()->merge([
            'first_name' => $request->profile['first_name'],
            'last_name' => $request->profile['last_name'],
        ]);
        $this->userRepository->store(request());
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
        if ($request->hasFile('file')) {
            $file = $request->file('file')->get();
            new ProcessUpload($file, [], $user->profile);
        }

        request()->merge([
            'first_name' => $request->profile['first_name'],
            'last_name' => $request->profile['last_name'],
        ]);
        $this->userRepository->update(request(), $user);
        return redirect()->route('user.index')->with('success', 'User successfully updated.');
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user);
        return redirect()->route('user.index')->with('success', 'User successfully deleted.');
    }
}
