<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability){
        // Check user role: 1 === User && 0 === Admin
        if (auth()->user()->role === 0) {
            return true;
        }
    }

    //Determine if the given comment can be created by the user.

    public function create(User $user)
    {
        return true;
    }

    //Determine if the given comment can be viewed by the user.

    public function view(User $user, Comment $comment)
    { 
        return $user->id === $comment->author_id;
    }


    //Determine if the given comment can be deleted by the user.

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->author_id;
    }    
}
