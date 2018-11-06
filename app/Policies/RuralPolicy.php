<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rural;

class RuralPolicy extends Policy
{
    public function update(User $user, Rural $rural)
    {
        // return $rural->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Rural $rural)
    {
        return true;
    }
}
