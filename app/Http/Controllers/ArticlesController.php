<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Auth;
use App\Handlers\ImageUploadHandler;

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


    public function show(Request $request, Article $article)
    {

        // URL 矫正
        if ( ! empty($article->slug) && $article->slug != $request->slug) {

            return redirect($article->link(), 301);

        }

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

		return redirect()->to($article->link())->with('message', '创建文章成功');
	}


	public function edit(Article $article)
	{
        //判斷是否用戶本人操作
        $this->authorize('update', $article);

        $categories = ArticleCategory::all();

		return view('articles.create_and_edit', compact('article', 'categories'));
	}


	public function update(ArticleRequest $request, Article $article)
	{
		//判斷是否用戶本人操作
        $this->authorize('update', $article);

		$article->update($request->all());

		return redirect()->to($article->link())->with('message', '更新文章成功');
	}


	public function destroy(Article $article)
	{
		//判斷是否用戶本人操作
        $this->authorize('destroy', $article);

		$article->delete();

		return redirect()->route('articles.index')->with('message', '删除文章成功');
	}

    //文章上传图片
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {

        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];

        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'articles', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }

        return $data;
    }
}