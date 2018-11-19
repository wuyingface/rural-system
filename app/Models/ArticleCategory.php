<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = [
        'name', 'description','img',
    ];


    public function setImgAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if (empty($path)) {
            $this->attributes['img'] = config('app.url') . "/img/2.jpg";;
        } else if ( ! starts_with($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.url') . "/uploads/images/article_category/$path";
            $this->attributes['img'] = $path;
        }


    }
}
