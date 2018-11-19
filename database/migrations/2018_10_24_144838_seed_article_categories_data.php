<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedArticleCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '乡村发展',
                'description' => '东风千野绿，乡村万年红',
                'img' => config('app.url') . "/img/2.jpg",
            ],
            [
                'name'        => '民风民俗',
                'description' => '感受传统习俗的魅力',
                'img' => config('app.url') . "/img/2.jpg",
            ],
            [
                'name'        => '文化建设',
                'description' => '乡村建设，文化为先',
                'img' => config('app.url') . "/img/2.jpg",
            ],
            [
                'name'        => '吃喝玩乐',
                'description' => '体验乡村多彩世界',
                'img' => config('app.url') . "/img/2.jpg",
            ],
            [
                'name'        => '随想随写',
                'description' => '须臾纳戒子，一花一世界',
                'img' => config('app.url') . "/img/2.jpg",
            ],
        ];

        DB::table('article_categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::table('article_categories')->truncate();
    }


}
