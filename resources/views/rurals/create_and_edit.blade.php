@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Rural /
                    @if($rural->id)
                        Edit #{{$rural->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($rural->id)
                    <form action="{{ route('rurals.update', $rural->id) }}" method="POST" accept-charset="UTF-8" class="form-horizontal">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('rurals.store') }}" method="POST" accept-charset="UTF-8" class="form-horizontal" style="width: 80%;"> 
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                    	<label for="name-field" class="col-sm-2 control-label">村民</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $rural->name ) }}" placeholder="请输入村名" />
                        </div>
                    </div>
                    <!-- <hr /> -->
                    <!-- 城市联级 -->
                    <div class="form-group">
                            <label for="name-field" class="col-sm-2 control-label">地址</label>
                        <div class="col-sm-10">
                            <select name="city" onchange="getCounty()" class="form-control cityCascade" id="city">
                                <option value="0">请选择所在的城市</option>
                                <option value="1">广州市</option>
                                <option value="2">深圳市</option>
                                <option value="3">佛山市</option> 
                                <option value="4">珠海市</option> 
                            </select>
                    
                            <select name="county" id="county" onchange="getTown()" class="form-control cityCascade">
                                <option value = "0">请选择所在的县区</option>
                            </select>
                    
                            <select name="town" class="form-control cityCascade" id="town">
                                <option value = "0">请选择所在的乡镇（街道）</option>
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
                                            <select class="form-control" onchange="selectOnchang(this)" name="type">
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
                    <!-- <hr /> -->
                    <!-- 介绍 -->
                    <div class="form-group">
                        <label for="editor" class="col-sm-2 control-label">介绍</label>
                        <div class="col-sm-10">
                            <textarea name="introdution" class="form-control" id="editor" rows="3" placeholder="请填入至少十三字符的内容。" required>{{ old('introdution', $rural->introdution ) }}</textarea>   
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
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('rurals.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
        width: 30%;
    }
    .tableHead {
        text-align: center;
        width: 20%;
        font-size: 12px;
    }
    </style>
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/editor/js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/simditor.js') }}"></script>
    
    <!-- 百度地图API -->
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7OOvPVfFtq8vZEUZn1Zv5Q7W4ndE4g0H"></script>

    <script type="text/javascript">
    // 文本框
    $(document).ready(function(){
        var editor = new Simditor({
            textarea: $('#editor'),
            upload: {
                url: '{{ route('articles.upload_image') }}',
                params: { _token: '{{ csrf_token() }}' },
                fileKey: 'upload_file',
                connectionCount: 3,
                leaveConfirm: '文件上传中，关闭此页面将取消上传。'
            },
            pasteImage: true,
        });
    });

    // mock数据
    var county = [
        ['天河区', '越秀区', '白云区'],
        ['福田区', '罗湖区', '宝安区'],
        ['南海区', '禅城区', '顺德区'],
        ['香洲区', '斗门区', '金湾区']
    ]
    var town = [
        [
            ['天河一村', '天河二村'],
            ['越秀一村', '越秀二村'],
            ['白云一村', '白云二村'],
        ],
        [
            ['福田一村', '福田二村'],
            ['罗湖一村', '罗湖二村'],
            ['宝安一村', '宝安二村'],
        ],
        [
            ['南海一村', '南海二村'],
            ['禅城一村', '禅城二村'],
            ['顺德一村', '顺德二村'],
        ],
        [
            ['香洲一村', '香洲二村'],
            ['斗门一村', '斗门二村'],
            ['金湾一村', '金湾二村'],
        ],
    ]
    // 城市联级
    var City = document.getElementById('city')
    var County = document.getElementById('county')
    var Town = document.getElementById('town')

    // 获取区县
    function getCounty() {
        County.length = 1
        Town.length = 1
        var getSelectIndex = City.selectedIndex
        // 获得市下面的区县
        var proCounty = county[getSelectIndex - 1]
        for (var i = 0; i < proCounty.length; i++) {
            County[i+1] = new Option(proCounty[i], getSelectIndex)
        }
    }
    // 获取乡镇
    function getTown() {
        var getSelectIndex = City.selectedIndex
        var getCountySelectIndex = County.selectedIndex
        var countytown = town[getSelectIndex - 1][getCountySelectIndex - 1]
        for( var i = 0; i < countytown.length; i++){
            Town[i+1] = new Option(countytown[0],getCountySelectIndex)
        }
    }

    // 地图
    var position = $('#position')
    var map = new BMap.Map('map')
    // 初始化地图
    if (position.val()) {
        var positionPoint = {}
        positionPoint.lng = position.val().split(',')[0]
        positionPoint.lat = position.val().split(',')[1]
        map.centerAndZoom(new BMap.Point(positionPoint.lng, positionPoint.lat))
        map.enableScrollWheelZoom()
    } else {
        map.centerAndZoom(new BMap.Point(113.331189,23.112153), 13);
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
                map.centerAndZoom(point, 16);
                map.addOverlay(new BMap.Marker(point));
            }
        }, city);
    }
    // 点击地图
    map.addEventListener('click', function (e) {
        $('#position').val(e.point.lng + ',' + e.point.lat)
    })
    </script>
@stop