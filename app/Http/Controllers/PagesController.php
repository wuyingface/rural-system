<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rural;
use App\Handlers\CommonHandler;
use App\Models\City;
use App\Models\County;
use App\Models\Town;
use DB;

class PagesController extends Controller
{

    //加载主视图
    public function root()
    {

        return view('pages.root');
    }

    //获取二级或者三级地区
    public function getArea($type, $id = '')
    {
        if ($id = '') {
            //获取一级行政区
            return $datas = DB::table($type)->select('id', 'name')->get();
        }

        return $datas = DB::table($type)->where($type.'_id', $id)->select('id','name')->get();
    }

}
