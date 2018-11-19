<?php

namespace App\Observers;

use App\Models\Rural;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class RuralObserver
{

    public function updating(Rural $rural)
    {

        //防止XSS攻击，过滤内容
        if ($rural->getOriginal('introdution') != $rural->introdution) {
            $rural->introdution = clean($rural->introdution, 'user_article_body');
        }


        // 当乡村名称发生修改时，相应更新slug、权限和角色名称,和
        if ($rural->getOriginal('name') != $rural->name) {

            //使用翻译器对 name 进行翻译
            $rural->slug = app(SlugTranslateHandler::class)->pinyin($rural->name);

            //获取旧村名
            $old_name = $rural->getOriginal('name');
            //寻找旧权限并修改名称
            DB::table('permissions')->where('name', '管理'.$old_name)
                                    ->update(['name' => '管理'.$rural->name]);
            //寻找旧角色并修改名称
            DB::table('roles')->where('name', $old_name.'管理员')
                              ->update(['name' => $rural->name.'管理员']);

        }
    }

    //在乡村创建时使用翻译器对 name 进行翻译
    public function creating(Rural $rural)
    {
        //使用翻译器对 name 进行翻译
        $rural->slug = app(SlugTranslateHandler::class)->pinyin($rural->name);

    }

    //在乡村创建之后生成相应的乡村管理员角色和权限
    public function created(Rural $rural)
    {
        $permission = Permission::create(['name' => '管理'.$rural->name]);
        $ruralAdministrator = Role::create(['name' => $rural->name.'管理员']);
        $ruralAdministrator->givePermissionTo($permission->name);
    }

    //生成默认乡村背景图片
    public function saving(Rural $rural)
    {
        if (empty($rural->background)) {
            $rural->background = config('app.url').'/img/rural_background.jpg';
        }
    }


}