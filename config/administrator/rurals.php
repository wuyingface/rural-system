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
            'sortable' => false,
            'output'   => function ($value, $model) {
                return $model->city->name;
            },
        ],

        'county' => [
            'title' => '所属县区',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return $model->county->name;
            },
        ],

        'town' => [
            'title' => '所属乡镇(街道)',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return $model->town->name;
            },
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
            'title'              => '所属城市',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],

        'county' => [
            'title'              => '所属县区(市)',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],

        'town' => [
            'title'              => '所属乡镇(街道)',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
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
            'title'              => '所属城市',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

        'county' => [
            'title'              => '所属县(区)',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

        'town' => [
            'title'              => '所属乡镇(街道)',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

        'location' => [
            'title' => '地理位置',
        ],
    ],

    // 新建和编辑时的表单验证规则
    'rules' => [
        'name' => 'required',
    ],

    // 表单验证错误时定制错误消息
    'messages' => [
        'name.required' => '请填写乡村名称',
    ]
];