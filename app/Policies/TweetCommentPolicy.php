<?php

namespace App\Policies;

use App\Models\TweetComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, TweetComment $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function destroy(User $user, TweetComment $comment)
    {
        return $user->id === $comment->user_id || $user->id === $comment->tweet->user_id;
    }
}
