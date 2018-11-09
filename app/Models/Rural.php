<?php

namespace App\Models;

class Rural extends Model
{
    protected $fillable = ['name', 'alias', 'population', 'type', 'postalcode', 'area_code', 'city', 'county', 'town', 'location', 'map', 'scenery', 'product', 'industry', 'railway_station', 'bus_station', 'airport', 'introdution'];

    public function link($params = [])
    {
        return route('rurals.show', array_merge([$this->id, $this->slug], $params));
    }

}
