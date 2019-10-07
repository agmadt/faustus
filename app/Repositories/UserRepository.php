<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $user = $this->model
            ->when(! empty($params['with']), function ($query) use ($params) {
                return $query->with($params['with']);
            })
            ->when(! empty($params['order']), function ($query) use ($params) {
                return $query->orderByRaw($params['order']);
            });

        if ($params['pagination']) {
            return $user->paginate($params['pagination']);
        }

        return $user->get();
    }

    public function findByColumn($column, $value)
    {
        $model = $this->model->where($column, $value)->first();

        if (! $model) {
            abort(404, 'User not found.');
        }

        return $model;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->model->create($request->all());
            $user->profile()->create($request->all());
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }

    public function update($request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update($request->all());
            $user->profile->update($request->all());
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }

    public function delete(User $user)
    {
        DB::beginTransaction();

        try {
            if (! empty($user->profile->avatar)) {
                Storage::delete($user->profile->avatar);
            }
            $user->profile->delete();
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }
}
