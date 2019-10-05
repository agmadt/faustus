<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $post = $this->model
            ->when(! empty($params['with']), function ($query) use ($params) {
                return $query->with($params['with']);
            })
            ->when(! empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });

        if ($params['pagination']) {
            return $post->paginate($params['pagination']);
        }

        return $post->get();
    }

    public function findByColumn($column, $value)
    {
        $model = $this->model->where($column, $value)->first();

        if (! $model) {
            abort(404, 'Post not found.');
        }

        return $model;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $post = $this->model->create($request->all());
            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }

    public function update($request, Post $post)
    {
        DB::beginTransaction();
        try {
            $post->update($request->all());
            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }

    public function delete(Post $post)
    {
        DB::beginTransaction();

        try {
            $post->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }
}
