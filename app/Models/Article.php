<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    //获取文章分类
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    //获取文章作者
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
