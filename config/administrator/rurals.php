<?php

use App\Models\Rural;

return [
    // 页面标题
    'title'   => '乡村管理',

    // 模型单数，用作页面『新建 $single』
    'single'  => '乡村',

    // 数据模型，用作数据的 CRUD
    'model'   => Rural::class,

    // 设置当前页面的访问权限，通过返回布尔值来控制权限。
    // 返回 True 即通过权限验证，False 则无权访问并从 Menu 中隐藏
    'permission'=> function()
    {
        return Auth::user()->can('管理用户');
    },

    // 字段负责渲染『数据表格』，由无数的『列』组成，
    'columns' => [

        // 列的标示，这是一个最小化『列』信息配置的例子，读取的是模型里对应
        // 的属性的值，如 $model->id
        'id' => [
            'title' => '序号',
        ],


        'city' => [
            'title' => '所属城市',
        ],

        'county' => [
            'title' => '所属县(区)',
        ],

        'town' => [
            'title' => '所属乡镇(街道)',
        ],

        'name' => [
            'title'    => '乡村名称',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/rurals/'.$model->id.'" target=_blank>'.$name.'</a>';
            },
        ],

        'location' => [
            'title' => '地理位置',
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    // 『模型表单』设置项
    'edit_fields' => [
        'name' => [
            'title' => '乡村名称',
        ],

        'city' => [
            'title' => '所属城市',
        ],

        'county' => [
            'title' => '所属县区(市)',
        ],

        'town' => [
            'title' => '所属乡镇(街道)',
        ],

        'location' => [
            'title' => '地理位置',
        ],
    ],

    // 『数据过滤』设置
    'filters' => [
        'name' => [
            'title' => '乡村名称',
        ],
        'city' => [
            'title' => '所属城市',
        ],
        'county' => [
            'title' => '所属县(区)',
        ],
        'town' => [
            'title' => '所属乡镇(街道)',
        ],
        'location' => [
            'title' => '地理位置',
        ],
    ],
];