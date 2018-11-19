<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    //生成默认图片
    public function saving(User $user)
    {
        if (empty($user->avatar)) {
            $user->avatar = config('app.url').'/uploads/images/avatars/default_avatar.jpg';
        }
    }
}