<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{

    //回复数量+1
    public function created(Reply $reply)
    {
        //防止XSS攻击
        $reply->content = clean($reply->content, 'user_article_body');

        $reply->article->increment('reply_count', 1);
    }

    //回复数量-1
    public function deleted(Reply $reply)
    {
        $reply->article->increment('reply_count', -1);
    }



}