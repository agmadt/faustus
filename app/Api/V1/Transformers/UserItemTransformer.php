<?php

namespace App\Api\V1\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserItemTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
            'first_name' => $user->profile->first_name,
            'last_name' => $user->profile->last_name,
        ];
    }
}
