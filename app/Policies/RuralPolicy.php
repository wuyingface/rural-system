<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rural;

class RuralPolicy extends Policy
{

    //乡村板块的编辑权限
    public function update(User $user, Rural $rural)
    {
        return $user->can('管理'.$rural->name) || $user->can('管理平台内容');
    }

}
