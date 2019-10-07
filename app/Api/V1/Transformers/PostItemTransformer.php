<?php

namespace App\Api\V1\Transformers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class PostItemTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'image' => $post->image ? Storage::url($post->image) : null,
        ];
    }
}
