<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rural;

class RuralPolicy extends Policy
{
    public function update(User $user, Rural $rural)
    {
        return ture;
    }

}
