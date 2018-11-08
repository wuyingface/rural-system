<?php

namespace App\Models;

class Rural extends Model
{
    protected $fillable = ['name'];


    public function link($params = [])
    {
        return route('rurals.show', array_merge([$this->id, $this->slug], $params));
    }

}
