<?php

namespace App\Policies;

use App\Models\User;
use App\Models\posts;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy{
    use HandlesAuthorization;
    /**
     * Determine whether the user can delete the model.
     * @param \App\Model\User $user
     * @return \App\Model\posts $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, posts $post){
        //
        return $user->id === $post->user_id;
    }

}
