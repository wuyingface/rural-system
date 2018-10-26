<?php

namespace App\Models;

class Article extends Model
{

    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];


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

    //文章排序方法（本地作用域）
    public function scopeWithOrder($query, $order)
    {
        //判断排序
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        //使用预加载
        return $query->with('user', 'category');
    }

    //按照最新回复排序
    public function scopeRecentReplied($query)
    {

        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    //按照最新文章排序
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }


}
