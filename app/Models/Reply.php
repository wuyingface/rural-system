<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];


    //获取回复的文章
    public function article ()
    {
        return $this->belongsTo(Article::class);
    }

    //获取回复的用户
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
