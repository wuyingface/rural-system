<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    //控制游客权限
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    //显示用户个人资料页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //加载编辑个人资料页面
    public function edit(User $user)
    {
        //授权
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    //确定提交个人资料编辑
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {

        //授权验证
        $this->authorize('update', $user);

        $data = $request->all();

        dd($request->avatar);

        //上传头像
        if ($request->avatar) {

            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
