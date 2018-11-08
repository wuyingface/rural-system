@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-body">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-edit"></i>
                    @if($article->id)
                        编辑文章
                    @else
                        新建文章
                    @endif
                </h2>

                <hr>

                @include('common.error')

                @if($article->id)
                    <form action="{{ route('articles.update', $article->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="category_id" required>
                            <option value="" hidden disabled {{ $article->id ? '' : 'selected' }}>请选择分类</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}" {{ $article->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少十三字符的内容。" required>{{ old('body', $article->body ) }}</textarea>
                    </div>

                    <div class="form-group" style="display: none;">
                        <input name="map" id="coordinate">
                    </div>
                        
                    <div class="form-group">
                        <input type="text" name="location" class="form-control" id="position" placeholder="请点击地图选取位置" style="width: 500px;display: inline-block;" readonly="readonly">
                        <a href="javascript:void(0);" onclick="hasMap()" id="hasMap">显示地图</a>
                    </div>

                    <div class="form-group">
                        <input type="text" name="location_name" class="form-control" style="display: none;margin-bottom: 5px;" id="userDefined" placeholder="自定义地址名称" />
                        <div style="display: none;" id="mapWrap">
                            <input class="form-control" type="text" placeholder="搜索位置" id="searchId">
                            <div id="map" style="height: 500px;"></div>
                        </div>
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
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
    /*去掉logo标签*/
    .BMap_cpyCtrl, .anchorBL{
        display:none;
    }
    </style>
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/editor/js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/editor/js/simditor.js') }}"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7OOvPVfFtq8vZEUZn1Zv5Q7W4ndE4g0H"></script>
    <script type="text/javascript">
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
        // 地图定位
        var position = document.getElementById('position');
        var map = new BMap.Map('map');
        if (position.value) {
            var coordinate = $('#coordinate').val()
            console.log(coordinate);
            var positionPoint = {}
            positionPoint.lng = coordinate.split(',')[0]
            positionPoint.lat = coordinate.split(',')[1]
            map.centerAndZoom(new BMap.Point(positionPoint.lng, positionPoint.lat), 15)
            map.enableScrollWheelZoom();
        } else {
            map.centerAndZoom(new BMap.Point(113.331189,23.112153), 13);
            map.enableScrollWheelZoom();
        }
        function hasMap() {
            var hasMap = document.getElementById('hasMap')
            var mapWrap = document.getElementById('mapWrap')
            if (hasMap.innerHTML === '隐藏地图') {
                mapWrap.style.display = 'none';
                hasMap.innerHTML = '显示地图'
            } else {
                mapWrap.style.display = 'block';
                hasMap.innerHTML = '隐藏地图'
                // 获取当前位置
                var point = new BMap.Point(116.331398,39.897445);
                map.centerAndZoom(point,12);
                var geolocation = new BMap.Geolocation();
                geolocation.getCurrentPosition(function(r){
                    console.log(r);
                    if(this.getStatus() == BMAP_STATUS_SUCCESS){
                        var mk = new BMap.Marker(r.point);
                        map.addOverlay(mk);
                        map.panTo(r.point);
                    }
                    else {
                        alert('failed'+this.getStatus());
                    }
                },{enableHighAccuracy: true})
            }
        }
        // 建立一个自动完成的对象
        var ac = new BMap.Autocomplete(
            {
                'input' : 'searchId',
                'location' : map
            }
        );
        var myValue;
        ac.addEventListener('onconfirm', function(e) {
            position.value = ''
            var _value = e.item.value;
            myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            setPlace(_value.city);
        });
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
            console.log(e);
            $('#coordinate').val(e.point.lng + ',' + e.point.lat)
            $('#userDefined').show()
            var myGeo = new BMap.Geocoder()
            myGeo.getLocation(new BMap.Point(e.point.lng, e.point.lat), function(rs){
                var addComp = rs.addressComponents;
                var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber
                position.value = address
            })
        })
    </script>
@stop


