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

                    @include('layouts.form')

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
            var positionPoint = {}
            positionPoint.lng = coordinate.split(',')[0]
            positionPoint.lat = coordinate.split(',')[1]
            var point = new BMap.Point(positionPoint.lng, positionPoint.lat)
            map.centerAndZoom(point, 18)
            var marker = new BMap.Marker(point)
            map.addOverlay(marker)
            map.enableScrollWheelZoom(true);
        } else {
            map.centerAndZoom(new BMap.Point(113.331189,23.112153), 15);
            map.enableScrollWheelZoom(true);
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
            myGeo.getPoint(myValue, function(point) {
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


