<?php

namespace App\Http\Controllers;

use App\Models\Rural;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RuralRequest;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\City;
use App\Models\County;
use App\Models\Town;
use App\Models\ArticleCategory;

class RuralsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(Request $request, Rural $rural)
    {

        // URL 矫正
        if ($rural->slug != $request->slug) {

            return redirect($rural->link(), 301);

        }

        $articleCategories = ArticleCategory::all();

        $city = City::where('id', $rural->city_id)->pluck('name');
        $county = County::where('id', $rural->county_id)->pluck('name');
        $town = Town::where('id', $rural->town_id)->pluck('name');

        return view('rurals.show', compact('rural', 'city', 'county', 'town', 'articleCategories'));
    }


	/*public function create(Rural $rural)
	{
		return view('rurals.create_and_edit', compact('rural'));
	}*/


	/*public function store(RuralRequest $request)
	{
		$rural = Rural::create($request->all());
		return redirect()->route('rurals.show', $rural->id)->with('message', 'Created successfully.');
	}*/


	public function edit(Rural $rural)
	{

        $this->authorize('update', $rural);

        $cities = City::all();
        $counties = County::all();
        $towns = Town::all();

		return view('rurals.create_and_edit', compact('rural', 'cities', 'counties', 'towns'));

	}


	public function update(RuralRequest $request, ImageUploadHandler $uploader, Rural $rural)
	{
        //授权验证
        $this->authorize('update', $rural);
		$data = $request->all();
        dd($request->background);
        //上传乡村背景图片
        if ($request->background) {

            $result = $uploader->save($request->background, 'rural_background', $rural->name, 1024);
            if ($result) {
                $data['background'] = $result['path'];
            }
        }

        $rural->update($data);

		return redirect()->to($rural->link())->with('message', '更新乡村信息成功.');
	}



    //乡村上传图片
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
            $result = $uploader->save($request->upload_file, 'rurals', \Auth::id(), 1024);
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