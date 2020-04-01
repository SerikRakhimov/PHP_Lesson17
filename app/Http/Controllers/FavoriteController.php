<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;


use App\Models\Post;

use function auth;
use function optional;


class FavoriteController extends Controller
{

    protected function hasfavorite(Post $post) {
        $userId = optional(auth()->user())->id;
        return $post->favorites()
            ->where('user_id', $userId)
            ->first();
    }

    function isfavorited(Post $post) {
        return [
            'is_favorited' => $this->hasfavorite($post) !== null
        ];
    }

    function favorite(Post $post) {

        $userId = auth()->user()->id;

         if ($favorite = $this->hasfavorite($post))
            $favorite->delete();
        else
            $post->favorites()->create(['user_id' => $userId]);

        return [
            'status' => 200
        ];
    }

}
