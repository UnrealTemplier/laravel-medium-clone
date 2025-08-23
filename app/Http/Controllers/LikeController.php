<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $hasLiked = Auth::user()->hasLiked($post);

        if ($hasLiked) {
            $post->likes()->where(['user_id' => Auth::id()])->delete();
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);
        }

        return response()->json([
            'likesCount' => $post->likes()->count()
        ]);
    }
}
