<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->get([
            'pagination' => 10,
        ]);

        $data = [
            'posts' => $posts,
        ];

        return view('post.index', $data);
    }

    public function create()
    {
        $data = [
            'post' => new Post,
        ];

        return view('post.create', $data);
    }

    public function store(PostStoreRequest $request)
    {
        $this->postRepository->store($request);
        return redirect()->route('post.index')
            ->with('success', 'Post successfully created.');
    }

    public function edit(Post $post)
    {
        $data = [
            'post' => $post,
        ];

        return view('post.edit', $data);
    }

    public function update(PostStoreRequest $request, Post $post)
    {
        $this->postRepository->update($request, $post);
        return redirect()->route('post.index')->with('success', 'Post successfully updated.');
    }

    public function delete(Post $post)
    {
        $this->postRepository->delete($post);
        return redirect()->route('post.index')->with('success', 'Post successfully deleted.');
    }
}
