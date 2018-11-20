<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rural;
use App\Handlers\CommonHandler;
use App\Models\City;
use App\Models\County;
use App\Models\Town;
use DB;
use App\Models\ArticleCategory;

class PagesController extends Controller
{

    //加载主视图
    public function root()
    {
        $articleCategories = ArticleCategory::all();
        $cities = DB::table('cities')->select('id', 'name')->get();
        $rurals = DB::table('rurals')->latest()->select('id', 'name', 'background', 'summary')->limit(5)->get();

        return view('pages.root', compact('cities', 'articleCategories', 'rurals'));
    }

    //获取二级或者三级地区
    public function getArea(Request $request)
    {
        $type = $request->type;

        if (!$request->id) {
            //获取一级行政区
            return $datas = DB::table($type)->select('id', 'name')->get();
        }

        return $datas = DB::table($type)->where($request->id_type.'_id', $request->id)->select('id','name')->get();
    }

}

