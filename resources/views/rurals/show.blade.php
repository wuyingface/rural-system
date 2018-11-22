@extends('layouts.app')



@section('content')
  <div class="container row">
    <div class="col-md-9 col-md-push-3 rightPart">
        <div class="introduct_header">
            <div class="jumbotron" style="background: url({{$rural->background}});background-repeat: no-repeat;background-size: 100% 100%; width: 100%; height: 100%;">
                <h1 class="introduct_header_name">{{$rural -> name}}</h1>
                <p class="introduct_header_summary">{{$rural->summary}}</p>
                @can('update', $rural)
                <a href="{{ route('rurals.edit', $rural->id) }}" class="btn btn-primary introduct_header_btn " role="button" style="float: right;">编辑</a>
                @endcan
            </div>
            <div class="focus_box"></div>
        </div>
        <!-- 渲染地图 -->
        <div class="row introduct_map" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <span id="coordinate" style="display: none;">{{$rural -> map}}</span>
                    <div class="panel-body">
                        <div id="tomap" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 概况 -->
        <div class="general">
            <div class="introduct_list row" style="padding-left: 15px;" id="introduct_list">
                <ul class="list-group col-md-6">
                    <li class="list-group-item">别名： {{$rural -> alias}}</li>
                    <li class="list-group-item">行政规划： {{$city[0]}}-{{$county[0]}}-{{$town[0]}}</li>
                    <li class="list-group-item">人口： {{$rural -> population}}</li>
                    <li class="list-group-item">方言： {{$rural -> dialect}}</li>
                    <li class="list-group-item">行政类别： {{$rural -> type}}</li>
                    <li class="list-group-item">邮政编码： {{$rural -> postalcode}}</li>
                    <li class="list-group-item">电话区号： {{$rural -> area_code}}</li>
                </ul>
                 <ul class="list-group col-md-6">
                    <li class="list-group-item">地理位置： {{$rural -> location}}</li>
                    <li class="list-group-item">著名景点： {{$rural -> scenery}}</li>
                    <li class="list-group-item">特色产品： {{$rural -> product}}</li>
                    <li class="list-group-item">特色产业： {{$rural -> industry}}</li>
                    <li class="list-group-item">火车站： {{$rural -> railway_station}}</li>
                    <li class="list-group-item">汽车站： {{$rural -> bus_station}}</li>
                    <li class="list-group-item">机场： {{$rural -> airport}}</li>
                </ul>
            </div>
            <div class="introduct_general">
                <p class="lead introduct_general_header">{{$rural -> name}}简介</p>
                @if($rural->introdution)
                <div style="background: #fff; padding: 10px; border-radius: 5px; border: 1px solid #d3e0e9;">
                    {!! $rural->introdution !!}
                </div>
                @endif
            </div>
        </div>
        <!-- 乡村简介 -->
        <div class="articleList" style="display: none;">
            <p class="lead" id="detailTitle"></p>
            <div class="list-group articlesGroup">
            </div>
        </div>
        <!-- 新增文章表单 -->
        <div class="createArticleMark">
            <form class="createArticle" action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">
                <h4 style="font-weight: bold;margin-bottom: 18px;">发表关于{{$rural->name}}的文章</h4>
                <span class="glyphicon glyphicon-remove closeBtn"></span>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="rural_id" value="{{ $rural->id }}">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" placeholder="请填写标题" required/>
                </div>

                <div class="form-group">
                    <select class="form-control" name="category_id" required>
                        <option value="" hidden disabled>请选择分类</option>
                            @foreach ($articleCategories as $articleCategory)
                                <option value="{{ $articleCategory->id }}">{{ $articleCategory->name }}</option>
                            @endforeach
                    </select>
                </div>
            
                <div class="form-group">
                    <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少十三字符的内容。" required="required"></textarea>
                </div>

                <div class="form-group" style="display: none;">
                    <input name="map" id="coordinate">

                </div>
                <!-- 地图 -->
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
    <div class="col-md-3 col-md-pull-9 leftPart">
        <ul class="nav nav-pills nav-stacked">
                <li class="nav_li"><a href="#">概况</a></li>
            @foreach ($articleCategories as $articleCategory)
                <li class="nav_li" data-categoryid="{{$articleCategory->id}}" data-ruralid="{{$rural->id}}" id="category_li"><a href="#">{{$articleCategory->name}}</a></li>
            @endforeach

        </ul>
        <button class="hasCreateArticle btn btn-primary">新建乡村文章</button>
    </div>
  </div>
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/editor/css/simditor.css') }}">
    <style>
        .createArticle {
            width: 700px;
            height: 700px;
            border: 1px solid #ccd0d2;
            position: absolute;
            padding: 45px;
            border-radius: 5px;
            z-index: 9999;
            top: 50%;
            left: 50%;
            margin-top: -350px;
            margin-left: -350px;
            background: #fff;
            box-shadow: 1px 1px 50px rgba(0,0,0,.3);
            border-radius: 2px;
            overflow: scroll;
        }
        .createArticleMark{
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.5);
            top: 0;
            left: 0;
            z-index: 2000;
            display: none;
        }
        .closeBtn{
            position: absolute;
            width: 30px;
            height: 30px;
            right: 0px;
            top: 10px;
            cursor: pointer;
        }
        .hasCreateArticle{
            margin-top: 20px;
        }
        .list-time{
            float: right;
            font-weight: 600;
        }
        .list_excerpt{
            font-size: 14px;
            letter-spacing: 1px;
            text-indent: 28px;
            line-height: 27px;
            margin-top: 11px;
            font-weight: normal;
        }
        .tangram-suggestion{
            z-index: 99999999 !important;
        }
        .list_title{
            font-weight: 700;
            padding: 22px 22px;
        }
        #detailTitle, .introduct_general_header{
            font-weight: 800;
            border-bottom: 7px solid;
            padding-bottom: 10px;
        }
        .introduct_header{
            height: 400px;
            margin-bottom: 20px;
            position: relative;
        }
        .focus_box {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 130px;
            background-color: rgba(0,0,0,0.4);
            z-index: 8;
            border-radius: 6px;
            overflow: hidden;
        }
        .introduct_header_name{
            position: absolute;
            bottom: 37px;
            color: #fff !important;
            z-index: 999;
        }
        .introduct_header_summary{
            position: absolute;
            bottom: 0px;
            color: #fff !important;
            z-index: 999;
        }
        .introduct_header_btn{
            position: absolute;
            right: 31px;
            bottom: 16px;
            z-index: 999;
        }
        .introduct_general_header{

        }
    </style>
@stop
@section('scripts')
<script type="text/javascript"  src="{{ asset('js/editor/js/module.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/editor/js/hotkeys.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/editor/js/uploader.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/editor/js/simditor.js') }}"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7OOvPVfFtq8vZEUZn1Zv5Q7W4ndE4g0H"></script>
<script type="text/javascript"  src="{{ asset('js/commonJs/map.js') }}"></script>
<script type="text/javascript">

    $(function () {
        // body...
        $('.nav_li:first-child').addClass('active')
        $('.nav_li').each(function () {
            $(this).click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            })
        })
        $('.nav_li:first-child').click(function() {
            $('.general').show()
            $('.articleList').hide()
            $('.introduct_map').show()
        })
        $('.nav_li:not(:first)').each(function () {
            $(this).click(function() {
                $('.articlesGroup').empty()
                $('.general').hide()
                $('.introduct_map').hide()
                $('.articleList').show()
                $('#detailTitle').html($(this).find('a').html())
                var category_id = $(this).data('categoryid')
                var rural_id = $(this).data('ruralid')
                $.ajax({
                    url: '/articleCategories/' + category_id + '/' + rural_id,
                    success: function(res) {
                        if (res.data.length) {
                            console.log(res.data[0].created_at.split(' ')[0]);
                            for (var i in res.data) {
                                var items = '<h4 class="list-group-item list_title" onclick="toArticle(\''+res.data[i].id+'\')" style="cursor: pointer;">' + res.data[i].title + '<p class="list_excerpt">' + res.data[i].excerpt+ '<span class="list-time">' + res.data[i].created_at.split(' ')[0]  +'</span>' + '</p>' +' </h4>'
                                $('.articlesGroup').append(items)
                            }
                        } else {
                            var nothing = '<p>' + '未找到结果' +'</p>'
                            $('.articlesGroup').append(nothing)
                        }
                    }
                })
            })
        })

        // 文本编辑器
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
        $('.hasCreateArticle').click(function(){
            $('.createArticleMark').show()
        })
        $('.closeBtn').click(function() {
            $('.createArticleMark').hide()
        })
        // 渲染地图
        var coordinate = $('#coordinate').html()
        console.log(coordinate)
        if (coordinate) {
            var positionPoint = {}
            positionPoint.lng = coordinate.split(',')[0]
            positionPoint.lat = coordinate.split(',')[1]
            var map = new BMap.Map('tomap');  
            var point = new BMap.Point(positionPoint.lng, positionPoint.lat);
            map.centerAndZoom(point, 20);
            var marker = new BMap.Marker(point)
            map.addOverlay(marker)
            map.enableScrollWheelZoom(true);
        } else {
            var map = new BMap.Map('tomap');  
            var point = new BMap.Point(113.275, 23.117);
            map.centerAndZoom(point, 20);
            var marker = new BMap.Marker(point)
            map.addOverlay(marker)
            map.enableScrollWheelZoom(true);
        }
    })
    function toArticle(id) {
        location.href= '/articles/' + id
    }
</script>
@stop