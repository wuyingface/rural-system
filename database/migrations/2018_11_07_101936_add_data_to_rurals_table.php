<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToRuralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rurals', function (Blueprint $table) {
            $table->string('alias', 30)->nullable()->commit('别名');
            $table->string('population', 20)->nullable()->commit('人口');
            $table->string('dialect', 30)->nullable()->commit('方言');
            $table->string('type', 10)->nullable()->commit('行政类别：自然村/行政村');
            $table->string('postalcode', 10)->nullable()->commit('邮政编码');
            $table->string('area_code', 10)->nullable()->commit('电话区号');
            $table->string('city', 20)->nullable()->commit('所属城市');
            $table->string('county', 20)->nullable()->commit('所属县区（市）');
            $table->string('town', 20)->nullable()->commit('所属乡镇（街道）');
            $table->string('location', 30)->nullable()->commit('所属乡镇（街道）');
            $table->string('map', 30)->nullable()->commit('经纬度');
            $table->string('scenery', 50)->nullable()->commit('著名景点');
            $table->string('product', 30)->nullable()->commit('特色产品');
            $table->string('industry', 30)->nullable()->commit('特色产业');
            $table->string('railway_station', 30)->nullable()->commit('火车站');
            $table->string('bus_station', 30)->nullable()->commit('汽车站');
            $table->string('airport', 30)->nullable()->commit('机场');
            $table->text('introdution')->nullable()->commit('简介');
            $table->string('slug')->nullable()->commit('优化url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rurals', function (Blueprint $table) {
            $table->dropColumn('alias');
            $table->dropColumn('population');
            $table->dropColumn('dialect');
            $table->dropColumn('type');
            $table->dropColumn('postalcode');
            $table->dropColumn('area_code');
            $table->dropColumn('city');
            $table->dropColumn('county');
            $table->dropColumn('town');
            $table->dropColumn('location');
            $table->dropColumn('map');
            $table->dropColumn('scenery');
            $table->dropColumn('product');
            $table->dropColumn('industry');
            $table->dropColumn('railway_station');
            $table->dropColumn('bus_station');
            $table->dropColumn('airport');
            $table->dropColumn('introdution');
            $table->dropColumn('slug');
        });
    }
}
