<?php

use App\Models\ArticleCategory;

return [
    'title'   => '文章分类',
    'single'  => '文章分类',
    'model'   => ArticleCategory::class,

    // 对 CRUD 动作的单独权限控制，其他动作不指定默认为通过
    'action_permissions' => [
        // 删除权限控制
        'delete' => function () {
            // 只有站长才能删除话题分类
            return Auth::user()->hasRole('站长');
        },
    ],

    'columns' => [
        'id' => [
            'title' => '序号',
        ],
        'name' => [
            'title'    => '文章分类名称',
            'sortable' => false,
        ],
        'img' => [
            'title'    => '分类图片',
            'output' => function ($img, $model) {
                return empty($img) ? 'N/A' : '<img src="'.$img.'" width="40">';
            },
            'sortable' => false,
        ],
        'description' => [
            'title'    => '描述',
            'sortable' => false,
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title' => '文章分类名称',
        ],
        'img' => [
            'title' => '分类图片',

            // 设置表单条目的类型，默认的 type 是 input
            'type' => 'image',

            // 图片上传必须设置图片存放路径
            'location' => public_path() . '/uploads/images/article_category/',
        ],
        'description' => [
            'title' => '描述',
            'type'  => 'textarea',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '分类 序号',
        ],
        'name' => [
            'title' => '文章分类名称',
        ],
        'description' => [
            'title' => '描述',
        ],
    ],
    'rules'   => [
        'name' => 'required|min:1|unique:article_categories'
    ],
    'messages' => [
        'name.unique'   => '分类名重复，请选用其他文章分类名称。',
        'name.required' => '请确保分类名称至少一个字符以上',
    ],
];