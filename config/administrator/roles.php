<?php

use Spatie\Permission\Models\Role;

return [
    'title'   => '角色',
    'single'  => '角色',
    'model'   => Role::class,

    'permission'=> function()
    {
        return Auth::user()->can('管理用户');
    },

    'columns' => [
        'id' => [
            'title' => '序号',
        ],
        'name' => [
            'title' => '角色名称'
        ],
        'permissions' => [
            'title'  => '权限',
            'output' => function ($value, $model) {
                $model->load('permissions');
                $result = [];
                foreach ($model->permissions as $permission) {
                    $result[] = $permission->name;
                }

                return empty($result) ? 'N/A' : implode($result, ' | ');
            },
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '角色名称',
        ],
        'permissions' => [
            'type' => 'relationship',
            'title' => '权限',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '序号',
        ],
        'name' => [
            'title' => '角色名称',
        ]
    ],

    // 新建和编辑时的表单验证规则
    'rules' => [
        'name' => 'required|max:15|unique:roles,name',
    ],

    // 表单验证错误时定制错误消息
    'messages' => [
        'name.required' => '角色名称不能为空',
        'name.unique' => '该角色已存在',
    ]
];