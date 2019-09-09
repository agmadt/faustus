<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Controllers\ApiController;
use App\Api\V1\Requests\UserStoreRequest;
use App\Api\V1\Requests\UserUpdateRequest;
use App\Api\V1\Transformers\UserItemTransformer;
use App\Models\User;
use App\Repositories\UserRepository;
use Dingo\Api\Http\Request;

/**
 * @group User
 *
 * APIs for user
 */
class UserController extends ApiController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->get([
            'with' => ['profile'],
            'pagination' => request('pagination') ?? 10,
        ]);

        return $this->response->paginator($users, new UserItemTransformer);
    }

    public function show(User $user)
    {
        return $this->response->item($user, new UserItemTransformer);
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->userRepository->store($request);
        return $this->response->item($user, new UserItemTransformer);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user = $this->userRepository->update($request, $user);
        return $this->response->item($user, new UserItemTransformer);
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user);

        return $this->response->array([
            'message' => 'User successfully deleted.',
            'code' => 200,
        ]);
    }
}
