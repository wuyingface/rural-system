<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationAndMapToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('location')->nullable()->commit('位置');
            $table->text('location_name')->nullable()->commit('自定义位置名称');
            $table->string('map')->nullable()->commit('经纬度');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('location_name');
            $table->dropColumn('map');
        });
    }
}
