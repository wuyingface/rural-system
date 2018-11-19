<?php

namespace App\Observers;

use App\Models\ArticleCategrory;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{

    //生成默认图片
    public function saving(ArticleCategrory $articleCategrory)
    {
        if (empty($articleCategrory->img)) {
            $articleCategrory->img = config('app.url') . "/img/2.jpg";
        }
    }
}