@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h2>
                    <i class="glyphicon glyphicon-edit"></i>
                   修改{{$rural->name}}信息
                </h2>
            </div>

            @include('common.error')

            <div class="panel-body">
                <form action="{{ route('rurals.update', $rural->id) }}" method="POST" accept-charset="UTF-8" class="form-horizontal" style="width: 92%;" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- 乡村概况 -->
                    <div class="form-group">

                        <label for="summary-field" class="col-sm-2 control-label">乡村概况</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="summary" id="summary-field" value="{{ old('summary', $rural->summary ) }}" placeholder="请输入乡村概况" />
                        </div>
                    </div>

                    <!-- 乡村背景图片 -->
                    <div class="form-group">

                        <label for="" class="col-sm-2 control-label">乡村背景</label>
                            <div class="col-sm-10">
                            <a href="javascript:;" class="file">
                                选择文件
                                <input type="file" name="background" id="file" onchange="showPic(this)" class="btn btn-default">
                            </a>
                            @if($rural->background)
                                <img class="thumbnail img-responsive" src="{{ $rural->background }}" width="200" id="preview"  />
                            @endif
                        </div>

                    </div>

                    <hr />
                    <!-- 城市联级 -->
                    <div class="form-group">
                        <label for="name-field" class="col-sm-2 control-label">地址</label>
                        <div class="col-sm-10">
                            <!-- 城市 -->
                            <select name="city_id" onchange="getCounty()" class="form-control cityCascade" id="city">
                                @foreach($cities as $city)
                                    @if($city -> id == $rural -> city_id)
                                        <option value="{{$city -> id}}" selected="selected">{{$city->name}}</option>
                                    @else
                                        <option value="{{$city -> id}}">{{$city->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <!-- 区县 -->
                            <select name="county_id" id="county" onchange="getTown()" class="form-control cityCascade" data-id="{{$rural -> county_id}}">
                            </select>
                            <!-- 城镇 -->
                            <select name="town_id" class="form-control cityCascade" id="town"  data-id="{{$rural -> town_id}}">
                            </select>
                        </div>
                    </div>
                    <!-- <hr /> -->

                    <!-- 地理位置 -->
                    <div class="form-group">
                        <label for="location-field" class="col-sm-2 control-label">地理位置</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="location" id="location-field" value="{{ old('location', $rural->location ) }}" placeholder="请输入地理位置" />
                        </div>
                    </div>
                    <!-- <hr /> -->

                    <!-- 概况 -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">概况</label>
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <?php
                                            $itemsFirst = ['别名', '人口', '方言', '行政类别', '邮政编码']
                                        ?>
                                        @foreach ($itemsFirst as $item)
                                        <th class="tableHead">{{$item}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="alias" placeholder="请输入别名" value="{{old('alias', $rural -> alias)}}" >
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="请输入人口数量" name="population" value="{{old('population', $rural -> population)}}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">人</button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="dialect" placeholder="请输入方言" value="{{old('dialect', $rural -> dialect)}}">
                                        </td>
                                        <td>
                                            <select class="form-control" name="type">
                                                <option>自然村</option>
                                                <option>行政村</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="postalcode" placeholder="请输入邮政编码" value="{{old('postalcode', $rural -> postalcode)}}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <?php
                                            $itemsSecond = ['电话区号', '著名景点', '特色产品', '特色产业', '火车站']
                                        ?>
                                        @foreach ($itemsSecond as $item)
                                        <th class="tableHead">{{$item}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="area_code" placeholder="请输入电话区号" value="{{old('area_code', $rural -> area_code)}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="scenery" placeholder="请输入著名景点" value="{{old('scenery', $rural -> scenery)}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product" placeholder="请输入特色产品" value="{{old('product', $rural -> product)}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="industry" placeholder="请输入特色产业" value="{{old('industry', $rural -> industry)}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="railway_station" placeholder="请输入火车站" value="{{old('railway_station', $rural -> railway_station)}}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <?php
                                            $itemsThird = ['汽车站', '机场']
                                        ?>
                                        @foreach ($itemsThird as $item)
                                        <th class="tableHead">{{$item}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="bus_station" placeholder="请输入汽车站"  value="{{old('bus_station', $rural -> bus_station)}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="airport" placeholder="请输入机场" value="{{old('airport', $rural -> airport)}}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr />
                    <!-- 介绍 -->
                    <div class="form-group">
                        <label for="editor" class="col-sm-2 control-label">介绍</label>
                        <div class="col-sm-10">
                            <textarea name="introdution" class="form-control" id="editor" rows="3" placeholder="请填入至少十三字符的内容。">{{ old('introdution', $rural->introdution ) }}</textarea>
                        </div>
                    </div>
                    <!-- <hr /> -->
                    <!-- 地图 -->
                    <div class="form-group">
                        <label for="name-field" class="col-sm-2 control-label">位置</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="position" name="map" placeholder="请选择地理坐标" style="display: inline-block;width: 500px;" readonly="readonly" value="{{old('map', $rural -> map)}}">
                            <a href="javascript:void(0);" onclick="hasMap()"  id="hasMap">显示地图</a>
                            <div id="mapWrap" style="display: none; margin-top: 5px;">
                                <input type="text" class="form-control" placeholder="搜索位置" id="searchId">
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="submit" class="btn btn-primary">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/editor/css/simditor.css') }}">
    <style>
    .cityCascade{
        display: inline-block;
        width: 32.9%;
    }
    .tableHead {
        text-align: center;
        width: 20%;
        font-size: 12px;
    }
    .file {
        position: relative;
        width: 100px;
        display: block;
        background: #3097D1;
        border: 1px solid #2a88bd;
        border-radius: 4px;
        padding: 4px 12px;
        overflow: hidden;
        color: #fff;
        text-decoration: none;
        text-indent: 0;
        line-height: 20px;
        text-align: center;
        margin-bottom: 10px;
    }
    .file input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
    }
    .file:hover {
        background: #2579a9;
        border-color: #1f648b;
        color: #fff;
        text-decoration: none;
    }
    </style>
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/editor/js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/simditor.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/city_data/city_data.js') }}"></script>

    <!-- 百度地图API -->
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=820EeAS7ihB2IyZLx1uSYP2vS9qlV4bo"></script>

    <script type="text/javascript">
    // 文本框
    $(document).ready(function(){
        var editor = new Simditor({
            textarea: $('#editor'),
            upload: {
                url: '{{ route('rurals.upload_rarul_img') }}',
                params: { _token: '{{ csrf_token() }}'},
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
        });
    });

    // 城市联级
    var City = document.getElementById('city')
    var County =document.getElementById('county')
    var Town = document.getElementById('town')
    var initCountyId

    // 初始化预加载区县数据
    function initCounty() {
        var initCityId = City.options[City.selectedIndex].value
        $.ajax({
            url: '/getArea',
            data: {
                type: 'counties',
                id: initCityId,
                id_type: 'cities'
            },
            success: function(res) {
                if (res) {
                    var id = $('#county').data('id')
                    for (var i = 0 ; i < res.length; i++ ) {
                        County[i] = new Option(res[i].name, res[i].id)
                    }
                    var nums = $('#county').find('option')
                    for (var j = 1; j < nums.length; j++) {
                        if ($(nums[j]).val() == id) {
                            $(nums[j]).attr('selected', 'selected')
                        }
                    }
                }
            }
        })
    }
    initCounty()
    // 初始化预加载城镇数据
    function initPreTown() {
        var initId = $('#county').data('id')
        $.ajax({
            url: '/getArea',
            data: {
                type: 'towns',
                id: initId,
                id_type: 'counties'
            },
            success: function(res) {
                // console.log(res);
                if (res) {
                    var id = $('#town').data('id')
                    for (var i = 0 ; i < res.length; i++ ) {
                        Town[i] = new Option(res[i].name, res[i].id)
                    }
                    var nums = $('#town').find('option')
                    for (var j = 1; j < nums.length; j++) {
                        if ($(nums[j]).val() == id) {
                            $(nums[j]).attr('selected', 'selected')
                        }
                    }
                }
            }
        })
    }
    initPreTown()
    // 联动获取区县数据
    function getCounty() {
        var citySelectId = City.value
        $.ajax({
            url: '/getArea',
            data: {
                type: 'counties',
                id: citySelectId,
                id_type: 'cities'
            },
            success: function(res){
                if (res) {
                    for (var i in res) {
                        County[i] = new Option(res[i].name, res[i].id)
                    }
                    initCountyId = County[0].value
                }
                initTown()
            }
        })
    }
    // 联动后获取区id初始化乡镇
    function initTown() {
        if (initCountyId !== undefined) {
            $.ajax({
                url: '/getArea',
                data: {
                    type: 'towns',
                    id: initCountyId,
                    id_type: 'counties'
                },
                success: function(res){
                    for(var u in res) {
                        Town[u] = new Option(res[u].name, res[u].id)
                    }
                }
            })
        }
    }
    // 联动获取乡镇数据
    function getTown() {
        var CountySelectId = County.value
        $.ajax({
            url: '/getArea',
            data: {
                type: 'towns',
                id: CountySelectId,
                id_type: 'counties'
            },
            success: function(res){
                if (res) {
                    for (var i in res) {
                        Town[i] = new Option(res[i].name, res[i].id)
                    }
                }
            }
        })
    }

    // 地图
    var position = $('#position')
    var map = new BMap.Map('map')
    // 初始化地图
    if (position.val()) {
        var positionPoint = {}
        positionPoint.lng = position.val().split(',')[0]
        positionPoint.lat = position.val().split(',')[1]
        // console.log(positionPoint);
        var point = new BMap.Point(positionPoint.lng, positionPoint.lat)
        map.centerAndZoom(point, 20)
        var marker = new BMap.Marker(point)
        map.addOverlay(marker)
        map.enableScrollWheelZoom()
    } else {
        map.centerAndZoom(new BMap.Point(113.331189,23.112153), 20);
        map.enableScrollWheelZoom()
    }
    // 是否显示地图
    function hasMap() {
        var hasMap = document.getElementById('hasMap')
        var mapWrap = document.getElementById('mapWrap')
        if (hasMap.innerHTML === '隐藏地图') {
            mapWrap.style.display = 'none';
            hasMap.innerHTML = '显示地图'
        } else {
            mapWrap.style.display = 'block';
            hasMap.innerHTML = '隐藏地图'
        }
    }
    // 自动创建一个对象
    var ac = new BMap.Autocomplete(
        {
            'input' : 'searchId',
            'location' : map
        }
    )
    // 触发搜索框
    var myValue;
    ac.addEventListener('onconfirm', function(e) {
        position.value = ''
        var _value = e.item.value;
        myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        setPlace(_value.city);
    });
    // 解析搜索地理位置
    function setPlace (city) {
        // 创建地址解析器实例
        var myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        myGeo.getPoint(myValue, function(point){
        // 获取输入地址的地理位置坐标
            if (point) {
                map.centerAndZoom(point, 20);
                map.addOverlay(new BMap.Marker(point));
            }
        }, city);
    }
    // 点击地图
    map.addEventListener('click', function (e) {
        $('#position').val(e.point.lng + ',' + e.point.lat)
    })
     function showPic(img) {
        document.getElementById("preview").src = window.URL.createObjectURL(img.files[0])
    }
    </script>
@stop