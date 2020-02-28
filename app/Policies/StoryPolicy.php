<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Story;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability){
        // Check user role: 1 === User && 0 === Admin
        if (auth()->user()->role === 0) {
            return true;
        }
    }

    //Determine if the given story can be created by the user.

    public function create(User $user)
    {
        return true;
    }

    //Determine if the given story can be viewed by the user.

    public function view(User $user, Story $story)
    { 
        return $user->id === $story->author_id;
    }


    //Determine if the given story can be updated by the user.

    public function update(User $user, Story $story)
    {
            return $user->id === $story->author_id;
    }


    //Determine if the given story can be deleted by the user.

    public function delete(User $user, Story $story)
    {
        return $user->id === $story->author_id;
    }    
}
