<?php

namespace App\Policies;

use App\Models\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment)
    {
        // возможность удаления записи - 10 минут с момента создания комментария
        return ($comment->user->id == $user->id) &&(time() <= (strtotime($comment->created_at) + (10 * 60)));

    }

}
