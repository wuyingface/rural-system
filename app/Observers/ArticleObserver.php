<?php

namespace App\Observers;

use App\Models\Article;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ArticleObserver
{
    public function creating(Article $article)
    {
        //
    }

    public function updating(Article $article)
    {
        //
    }

    //在文章创建之前生成内容摘要
    public function saving(Article $article)
    {

        //防止XSS攻击，过滤内容
        $article->body = clean($article->body, 'user_article_body');

        $article->excerpt = make_excerpt($article->body);
    }
}