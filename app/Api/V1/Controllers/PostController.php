<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Controllers\ApiController;
use App\Api\V1\Transformers\PostItemTransformer;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Dingo\Api\Http\Request;

/**
 * @group Post
 *
 * APIs for post
 */
class PostController extends ApiController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(User $user)
    {
        $posts = $this->postRepository->get([
            'user_id' => $user->id,
            'pagination' => request('pagination') ?? 10,
        ]);

        return $this->response->paginator($posts, new PostItemTransformer);
    }

    public function show(User $user, Post $post)
    {
        return $this->response->item($post, new PostItemTransformer);
    }

    public function store(PostStoreRequest $request, User $user)
    {
        $request->only(['title', 'description']);
        $request->merge(['user_id' => $user->id]);
        $post = $this->postRepository->store($request);
        return $this->response->item($post, new PostItemTransformer);
    }

    public function update(PostStoreRequest $request, User $user, Post $post)
    {
        $request->only(['title', 'description']);
        $post = $this->postRepository->update($request, $post);
        return $this->response->item($post, new PostItemTransformer);
    }

    public function delete(User $user, Post $post)
    {
        $this->postRepository->delete($post);

        return $this->response->array([
            'message' => 'Post successfully deleted.',
            'code' => 200,
        ]);
    }
}
