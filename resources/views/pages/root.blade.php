@extends('layouts.app')
@section('title')

@section('content')
  <div class="container">
  	<!-- 头部搜索 -->
  	<div class="page-header">
  		<h1 style="margin-bottom: 24px;">欢迎来到村村汇</h1>
  		<!-- 搜索 -->
  		<!-- <div class="input-group input-group-lg" style="width: 60%;"> -->
  			<!-- <input type="text" class="form-control">
  			<div class="input-group-btn">
  				<button type="submit" class="btn btn-primary">搜索</button>
  			</div> -->
  		<!-- </div> -->
  		<!-- <div class="recentSearch" style="margin-top: 10px;">
  			<span style="display: inline-block;position: relative;top: -13px;">最近搜索：</span>
  			<ul class="nav nav-pills" style="display: inline-block;">
			  	<li><a href="#">Home</a></li>
			</ul>
  		</div> -->
	</div>

	<!-- 轮播图 -->
	<div class="container">
		  <div class="TB-focus" style="margin:0 auto"> 
		   <div class="bd"> 
			    <ul > 
			    	@foreach($rurals as $rural)
				    <li >
				    	<a href="/rurals/{{$rural->id}}" target="_blank">
				    		<img src="{{$rural->background}}" />
				    		<span class="slide_name">{{$rural -> name}}</span>
							<span class="slide_summary">{{$rural -> summary}}</span>
				    	</a>
				    </li> 
				    @endforeach
			    </ul> 
			    <div class="focus_box"></div>
		   </div> 
		   <!-- 前后按钮 -->
			<a class="prev" href="javascript:void(0)"></a>
			<a class="next" href="javascript:void(0)"></a>
  		</div>
	</div>
	
	<!-- 城市联动 -->
	<div class="container">
		<div class="page-header" style="border-bottom: 5px solid #000;color: #000;">
		  	<h2>寻找乡村</h2>
		</div>
		<div class="scrollBox" style="margin:0 auto" id="cityscrollBox">
		   <div class="ohbox">
		    	<div class="tempWrap" style="overflow:hidden; position:relative; width:90%">
		     		<ul class="piclist" style="width: 2484px; left: -1656px; overflow: hidden; padding: 0px; margin: 0px;" id="cities">
		     			@foreach($cities as $city)
						<li onclick="getCounties({{$city->id}})">
							<a>
								<img src="/city_img/{{$city->name}}.png" />
								<span style="height: 60px;line-height: 60px;">{{$city->name}}</span>
							</a>
						</li>
		     			@endforeach
		     		</ul>
		    	</div>
		   	</div>

		   	<div class="pageBtn">
			    <span class="prev glyphicon glyphicon-chevron-left"></span>
			    <span class="next glyphicon glyphicon-chevron-right"></span>
			    <ul class="list" style="display: none;">
					<li class="on">0</li>
					<li class="">1</li>
					<li class="">2</li>
			    </ul>
		   	</div>

		</div>
	</div>

	<!-- 城市联动弹出框 -->
	<div class="container cityCascade">
		<div class="countyWrap" id="countyWrap">
			<ul class="nav nav-pills" role="tablist" id="counties"></ul>
			<span class="glyphicon glyphicon-remove closeConuty" onclick="closeConuty()"></span>
		</div>
	</div>


	<!-- 信息栏 -->
	<div class="container">
		<div class="page-header" style="border-bottom: 5px solid #000;color: #000;">
		  	<h2>文章分类</h2>
		</div>
		<div class="scrollBox" style="margin:0 auto">
		   <div class="ohbox">
		    	<div class="tempWrap" style="overflow:hidden; position:relative; width:100%">
		     		<ul class="piclist" style="width: 2484px; left: -1656px; position: relative; overflow: hidden; padding: 0px; margin: 0px;">
		     			@foreach($articleCategories as $articleCategory)
						<li>
							<a href="{{ route('articleCategories.show', $articleCategory->id) }}"><img src="{{$articleCategory->img}}" /><span>{{$articleCategory->name}}</span></a>
						</li>
		     			@endforeach
		     		</ul>
		    	</div>
		   	</div>
		   	<div class="pageBtn">
			    <span class="prev glyphicon glyphicon-chevron-left"></span>
			    <span class="next glyphicon glyphicon-chevron-right"></span>
			    <ul class="list" style="display: none;">
					<li class="on">0</li>
					<li class="">1</li>
					<li class="">2</li>
			    </ul>
		   	</div>
		</div>
	</div>


</div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/editor/css/simditor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/sliderShow/css/slider.css') }}">
    <style>
		.TB-focus {
		    width: 100%;
			height: 450px;
		    border: 1px solid #D8D8D8;
		    position: relative;
		    overflow: hidden;
		}
		.TB-focus .hd {
		    position: absolute;
		    right: 9px;
		    bottom: 10px;
		    z-index: 99999;
		    padding-left: 2px;
		}
		.TB-focus .hd li.on {
		    background: #000;
		    opacity: 1;
		    filter: alpha(opacity=100);
		    z-index: 2;
		    position: relative;
		}
		.TB-focus .hd li {
		    overflow: visible;
		    opacity: .7;
		    filter: alpha(opacity=70);
		    list-style: none;
		    float: left;
			margin-right: 8px;
			width: 15px;
			height: 15px;
			line-height: 14px;
			text-align: center;
			background: #fff;
			cursor: pointer;
			border-radius: 20px;
		}
		.TB-focus .bd ul{
			width: 100% !important;
		}
		.TB-focus .bd li{
			width: 100% !important;
		}
		.TB-focus .bd li img{
			width: 100%;
			height: 450px;
			display: block;
		}
		
		.TB-focus .prev:hover,
				.TB-focus .next:hover {
			filter: alpha(opacity=100);
			opacity: 1;
		}

		.TB-focus .prevStop {
			display: none;
		}

		.TB-focus .nextStop {
			display: none;
		}
		.TB-focus .prev, .TB-focus .next {
			position: absolute;
			left: 3%;
			top: 50%;
			margin-top: -25px;
			display: block;
			width: 32px;
			height: 40px;
			background: url('{{asset('js/sliderShow/img/slider-arrow.png')}}') -110px 5px no-repeat;
			filter: alpha(opacity=50);
			opacity: 0.7;
		}
		.TB-focus .next {
			left: auto;
			right: 3%;
			background-position: 8px 5px;
		}
		.countyWrap {
			width: 86%;
			height: 200px;
			background: #fff;
			margin-left: 79px;
			position: relative;
			display: none;
			padding: 15px;
			z-index: 99999;
			border: 1px solid #ddd;
			box-shadow: 1px 1px 10.7px;
		}
		.countyWrap ul li a {
			color: #000;
		}
		.cityCascade{
			position: absolute;
		}
		.cityBack{
			position: absolute;
			bottom: 20px;
			right: 20px;
		}
		.closeConuty{
			position: absolute;
			right: 10px;
			top: 10px;
			cursor: pointer;
		}
		#counties li {
			cursor: pointer;
		}
		.slide_wrap{
			position: relative;
			color: #000;
		}
		.slide_name {
			position: absolute;
			font-size: 40px;
			z-index: 1111;
			left: 80px;
			color: #fff;
			bottom: 42px;
		}
		.slide_summary{
			position: absolute;
			bottom: 16px;
			font-size: 19px;
			color: #fff;
			left: 79px;
			z-index: 9999;
		}
		.focus_box{
			position: absolute;
			left: 0;
			bottom: 0;
			width: 100%;
			height: 100px;
			background-color: rgba(0,0,0,0.4);
			z-index: 8;
			overflow: hidden;
		}
    </style>
@stop

@section('scripts')
<script src="{{ asset('js/sliderShow/js/jquery.SuperSlide.2.1.3.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	// 信息栏、城市
	jQuery(".scrollBox").slide({ titCell:".list li", mainCell:".piclist", effect:"left",vis:4,scroll:4,delayTime:800,trigger:"click",easing:"easeOutCirc"});

	// 轮播图
	jQuery(".TB-focus").slide({ mainCell:".bd ul",effect:"fold",autoPlay:true,delayTime:200 });

	function common (id, type, id_type, getData, flag) {
		if (flag) {
			$('#countyWrap').show()
		}
		$('#counties').empty()
		$.ajax({
			url: '/getArea',
			data: {
				type: type,
				id: id,
				id_type: id_type
			},
			success: function(res) {
				if (res) {
					for (var i in res) {
						var items = '<li role="presentation" onclick="getData(\''+res[i].id+'\')">'+ '<a>' + '<span>' + res[i].name + '</span>' + '</a>' + '</li>'
						$('#counties').append(items)
					}
				}
			}
		})
	}
	function getCounties(id) {
		city_id = id
		$('#countyWrap').show()
		$('#counties').empty()
		$.ajax({
			url: '/getArea',
			data: {
				type: 'counties',
				id: id,
				id_type: 'cities'
			},
			success: function(res) {
				if (res) {
					for (var i in res) {
						var items = '<li role="presentation" onclick="getTowns(\''+res[i].id+'\')">'+ '<a>' + '<span>' + res[i].name + '</span>' + '</a>' + '</li>'
						$('#counties').append(items)
					}
				}
			}
		})
	}
	function getTowns(id) {
		$('#counties').empty()
		$.ajax({
			url: '/getArea',
			data: {
				type: 'towns',
				id: id,
				id_type: 'counties'
			},
			success: function(res) {
			// console.log(res);
				if (res) {
					for (var i in res) {
						var items = '<li role="presentation" onclick="getRurals(\''+res[i].id+'\', \''+id+'\')">'+ '<a>' + '<span>' + res[i].name + '</span>' + '</a>' + '</li>'
						$('#counties').append(items)
					}
					var btn = '<button class="btn btn-primary cityBack" onclick="countyBack(\''+city_id+'\')">' + '返回' + '</button>'
					$('#counties').append(btn)
				}
			}
		})
	}

	function getRurals(id, counties_id) {
		$('#counties').empty()
		$.ajax({
			url: '/getArea',
			data: {
				type: 'rurals',
				id: id,
				id_type: 'town'
			},
			success: function(res) {
				console.log(res);
				if (res.length) {
					for (var i in res) {
						var items = '<li role="presentation" onclick="toRural(\''+res[i].id+'\')">'+ '<a>' + '<span>' + res[i].name + '</span>' + '</a>' + '</li>'
						$('#counties').append(items)
					}
					var btn = '<button class="btn btn-primary cityBack" onclick="townBack(\''+counties_id+'\')">' + '返回' + '</button>'
					$('#counties').append(btn)
				} else {
					var nothing = '<p>' + '未找到结果' +'</p>'
					var btn = '<button class="btn btn-primary cityBack" onclick="townBack(\''+counties_id+'\')">' + '返回' + '</button>'
					$('#counties').append(btn)
					$('#counties').append(nothing)
				}
			}
		})
	}
	function countyBack(id) {
		getCounties(id)
	}
	function townBack(id) {
		getTowns(id)
	}
	function closeConuty() {
		$('#countyWrap').hide()
	}
	function toRural(id) {
		location.href= '/rurals/' + id
	}
</script>
@stop

