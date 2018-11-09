<?php

namespace App\Http\Controllers;

use App\Models\Rural;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RuralRequest;
use Auth;
use App\Handlers\ImageUploadHandler;

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

        return view('rurals.show', compact('rural'));
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
		return view('rurals.create_and_edit', compact('rural'));
	}


	public function update(RuralRequest $request, Rural $rural)
	{
		//dd($request->all());
        $this->authorize('update', $rural);
		$rural->update($request->all());

		return redirect()->to($rural->link())->with('message', '更新乡村信息成功.');
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