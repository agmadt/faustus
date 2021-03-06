<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Processor\ProcessUpload;
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
        $page = request()->page ?? 1;
        $pagination = 10;
        $posts = $this->postRepository->get([
            'pagination' => $pagination,
        ]);

        $data = [
            'no' => ($page - 1) * $pagination,
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
        if ($request->hasFile('file')) {
            $file = $request->file('file')->get();
            new ProcessUpload($file, [
                'width' => 400,
                'path' => 'post',
                'column' => 'image',
            ]);
        }

        request()->merge([
            'user_id' => auth()->user()->id,
        ]);
        $this->postRepository->store(request());
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
        if ($request->hasFile('file')) {
            $file = $request->file('file')->get();
            new ProcessUpload($file, [
                'width' => 400,
                'path' => 'post',
                'column' => 'image',
            ], $post);
        }

        $this->postRepository->update(request(), $post);
        return redirect()->route('post.index')->with('success', 'Post successfully updated.');
    }

    public function delete(Post $post)
    {
        $this->postRepository->delete($post);
        return redirect()->route('post.index')->with('success', 'Post successfully deleted.');
    }
}
