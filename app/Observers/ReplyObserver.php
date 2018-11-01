<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{

    //回复数量+1
    public function created(Reply $reply)
    {
        //防止XSS攻击
        $reply->content = clean($reply->content, 'user_article_body');

        $article = $reply->article;
        $article->increment('reply_count', 1);

        // 通知作者文章被回复了
        $article->user->notify(new TopicReplied($reply));

    }


    //回复数量-1
    public function deleted(Reply $reply)
    {
        $reply->article->decrement('reply_count', 1);
    }


}