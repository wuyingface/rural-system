<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 先创建权限
        Permission::create(['name' => '管理文章']);
        Permission::create(['name' => '管理用户']);
        Permission::create(['name' => '修改设置']);

        // 创建站长角色，并赋予权限
        $founder = Role::create(['name' => '站长']);
        $founder->givePermissionTo('管理文章');
        $founder->givePermissionTo('管理用户');
        $founder->givePermissionTo('修改设置');

        // 创建管理员角色，并赋予权限
        $maintainer = Role::create(['name' => '综合管理员']);
        $maintainer->givePermissionTo('管理文章');
    }

    public function down()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}