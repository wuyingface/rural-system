<?php

namespace App\Handlers;


class CommonHandler
{
    //多维数组去重
    public static function delRepeat($datas)
    {
        foreach($datas[0] as $k => $v){
            //先把二维数组中的内层数组的键值记录在在一维数组中
            $arr_inner_key[]= $k;
        }
        $tmp = [];
        foreach ($datas as $k => $v) {
            //降维
            if (!is_array($v)) {
                json_decode($v);
            }

            $value = implode(',', $v);
            $tmp[$k] = $value;
        }
        //去重
        $tmp = array_unique($tmp);
        foreach ($tmp as $k => $v) {
            $arr = explode(",",$v);
            //将原来的键与值重新合并
            $new_arr[$k]= array_combine($arr_inner_key,$arr);
        }
        return $new_arr;
    }
}