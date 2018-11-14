<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\City;
use App\Models\County;
use App\Models\Town;

class SeedCitiesAndCountiesAndTownData extends Migration
{





    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $area_datas = Array(
        '潮州市'=> [
            '湘桥区'=>['湘桥','西湖','金山','太平','南春','西新','桥东','城西','凤新','意溪镇','磷溪镇','铁铺镇','官塘镇','红山林场','开发区'],
            '潮安区'=>['古巷镇','登塘镇','凤塘镇','浮洋镇','龙湖镇','金石镇','沙溪镇','彩塘镇','东凤镇','庵埠镇','江东镇','归湖镇','文祠镇','凤凰镇','赤凤镇','枫溪镇','万峰林场','大坑苗圃场','东山湖农场','庵埠经济开发试验区'],
            '饶平县'=>['黄冈镇','钱东镇','海山镇','大埕镇','所城镇','柘林镇','汫洲镇','樟溪镇','浮山镇','汤溪镇','三饶镇','联饶镇','新圩镇','新丰镇','饶洋镇','上饶镇','建饶镇','高堂镇','浮滨镇','新塘镇','东山镇','韩江林场'],
        ],

        );

        foreach ($area_datas as $k1 => $v1 )
        {
            $city = City::firstOrCreate(
                ['name' => $k1]
            );

            foreach ($v1 as $k2 => $v2)
            {
                $county = County::firstOrCreate(
                    ['name' => $k2],
                    ['cities_id' => $city->id]
                );

                foreach ($v2 as $v3)
                {
                    $town = Town::firstOrCreate(
                    ['name' => $v3],
                    ['counties_id' => $county->id]
                );
                }

            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('twons')->truncate();
        DB::table('counties')->truncate();
        DB::table('cities')->truncate();
    }
}
