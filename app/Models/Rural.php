<?php

namespace App\Models;

class Rural extends Model
{
    protected $fillable = ['name', 'alias', 'dialect', 'population', 'type', 'postalcode', 'area_code', 'city_id', 'county_id', 'town_id', 'location', 'map', 'scenery', 'product', 'industry', 'railway_station', 'bus_station', 'airport', 'introdution'];

    public function link($params = [])
    {
        return route('rurals.show', array_merge([$this->id, $this->slug], $params));
    }


    //获取所属城市
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    //获取所属县区
    public function county()
    {
        return $this->belongsTo(County::class);
    }

    //获取所属乡镇
    public function town()
    {
        return $this->belongsTo(Town::class);
    }

}
