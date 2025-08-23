<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function toggleFollow(User $user): JsonResponse
    {
        $user->followers()->toggle(Auth::user());

        return response()->json([
            'followersCount' => $user->followers()->count()
        ]);
    }
}
