<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Auth;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


	public function index(Request $request, Article $article)
	{
		/*$articles = Article::with('user', 'category')->paginate(20);
		return view('articles.index', compact('articles'));*/
        $articles = $article->withOrder($request->order)->paginate(20);
        return view('articles.index', compact('articles'));
	}


    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }


	public function create(Article $article)
	{
		$categories = ArticleCategory::all();
        return view('articles.create_and_edit', compact('article', 'categories'));
	}


	public function store(ArticleRequest $request, Article $article)
	{
		$article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();

		return redirect()->route('articles.show', $article->id)->with('message', '创建文章成功');
	}


	public function edit(Article $article)
	{
        $this->authorize('update', $article);
		return view('articles.create_and_edit', compact('article'));
	}


	public function update(ArticleRequest $request, Article $article)
	{
		$this->authorize('update', $article);
		$article->update($request->all());

		return redirect()->route('articles.show', $article->id)->with('message', 'Updated successfully.');
	}


	public function destroy(Article $article)
	{
		$this->authorize('destroy', $article);
		$article->delete();

		return redirect()->route('articles.index')->with('message', 'Deleted successfully.');
	}
}