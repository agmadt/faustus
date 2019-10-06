<?php

namespace App\Api\V1\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostItemTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
        ];
    }
}
