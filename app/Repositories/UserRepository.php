<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function get($pagination = null, $with = null)
    {
        $user = User::when($with, function ($query) use ($with) {
            return $query->with($with);
        });

        if ($pagination) {
            return $user->paginate($pagination);
        }

        return $user->get();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->all());
            $user->profile()->create($request->all());
        } catch (\Exception $e) {
            DB::rollBack();
            throw \Exception($e);
        }

        DB::commit();
    }

    public function update(Request $request, User $user)
    {
        DB::beginTransaction();

        try {
            $user->update($request->all());
            $user->profile->update($request->all());
        } catch (\Exception $e) {
            DB::rollBack();
            throw \Exception($e);
        }

        DB::commit();
    }
}
