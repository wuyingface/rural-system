<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleCategroiesController extends Controller
{
    public function show(ArticleCategory $articleCategory)
    {

        // 读取分类关联的话题，并按每 20 条分页
        $articles = Article::where('category_id', $articleCategory->id)->paginate(20);
        // 传参变量话题和分类到模板中
        return view('articles.index', compact('articles', 'articleCategory'));
    }
}
