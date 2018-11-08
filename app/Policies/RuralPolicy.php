<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rural;

class RuralPolicy extends Policy
{

    public function update(User $user, Rural $rural)
    {
        if ($user->can('管理'.$rural->name) || $user->can('管理平台内容')) {
            return ture;
        }
    }

}
