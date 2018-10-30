<?php

namespace App\Observers;

use App\Models\Article;
use App\Handlers\SlugTranslateHandler;

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
        // 如 slug 字段无内容，或者標題更改了，即使用翻译器对 title 进行翻译
        if (!$article->slug || ($article->getOriginal('title') != $article->title)) {
            $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }
    }

    //在文章创建之前生成内容摘要
    public function saving(Article $article)
    {

        //防止XSS攻击，过滤内容
        $article->body = clean($article->body, 'user_article_body');
        // 生成话题摘录
        $article->excerpt = make_excerpt($article->body);

        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $article->slug) {
            $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }

    }
}