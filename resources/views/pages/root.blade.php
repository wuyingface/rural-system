@extends('layouts.app')
@section('title')

@section('content')
  <div class="container">
  	<!-- 头部搜索 -->
  	<div class="page-header">
  		<h1 style="margin-bottom: 24px;">欢迎来到村村汇</h1>
  		<div class="input-group input-group-lg" style="width: 60%;">
  			<input type="text" class="form-control">
  			<div class="input-group-btn">
  				<button type="submit" class="btn btn-primary">搜索</button>
  			</div>
  		</div>
  		<div class="recentSearch" style="margin-top: 10px;">
  			<span style="display: inline-block;position: relative;top: -13px;">最近搜索：</span>
  			<ul class="nav nav-pills" style="display: inline-block;">
			  	<li><a href="#">Home</a></li>
			</ul>
  		</div>
	</div>

	<!-- 轮播图 -->
	<div class="container">
		<div id="slideBox" class="slideBox">
			<div class="hd">
				<ul>
					<li class=""></li>
					<li class="on"></li>
					<li class=""></li>
				</ul>
			</div>
			<div class="bd">
				<ul>
					<li style="display: none;">
						<a href="" target="_blank">
							<img src="{{asset('img/1.jpg')}}">
						</a>
					</li>
					<li style="display: list-item; opacity: 0.84;">
						<a href="" target="_blank">
							<img src="{{asset('img/2.jpg')}}">
						</a>
						</li>
					<li style="display: none;">
						<a href="" target="_blank">
							<img src="{{asset('img/3.jpg')}}">
						</a>
					</li>
				</ul>
			</div>

			<!-- 下面是前/后按钮代码-->
			<a class="prev" href="javascript:void(0)"></a>
			<a class="next" href="javascript:void(0)"></a>

		</div>
	</div>
	
	<!-- 城市联动 -->
	<div class="container">
		<div class="page-header" style="border-bottom: 5px solid #000;color: #000;">
		  	<h2>城市</h2>
		</div>
		<div class="scrollBox" style="margin:0 auto"> 
		   <div class="ohbox"> 
		    	<div class="tempWrap" style="overflow:hidden; position:relative; width:100%">
		     		<ul class="piclist" style="width: 2484px; left: -1656px; overflow: hidden; padding: 0px; margin: 0px;" id="cities"> 
				      	<!-- <li><a href="" target="_blank"><span>乡村发展</span></a></li> 
				      	<li><a href="" target="_blank"><span>民风民俗</span></a></li> 
				      	<li><a href="" target="_blank"><span>文化建设</span></a></li> 
				      	<li><a href="" target="_blank"><span>吃喝玩乐</span></a></li> 
				      	<li><a href="" target="_blank"><span>随想随写</span></a></li> 
				      	<li><a href="" target="_blank"><span>乡村发展2</span></a></li> 
				      	<li><a href="" target="_blank"><span>民风民俗2</span></a></li> 
				      	<li><a href="" target="_blank"><span>文化建设2</span></a></li> 
				      	<li><a href="" target="_blank"><span>吃喝玩乐2</span></a></li> 
				      	<li><a href="" target="_blank"><span>随想随写2</span></a></li> 
				      	<li><a href="" target="_blank"><span>乡村发展3</span></a></li> 
				      	<li><a href="" target="_blank"><span>民风民俗3</span></a></li>  -->
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
		   	<div class="popWrap">
		   		
		   	</div>
		</div>
	</div>


	<!-- 信息栏 -->
	<div class="container">
		<div class="page-header" style="border-bottom: 5px solid #000;color: #000;">
		  	<h2>信息</h2>
		</div>
		<div class="scrollBox" style="margin:0 auto"> 
		   <div class="ohbox"> 
		    	<div class="tempWrap" style="overflow:hidden; position:relative; width:100%">
		     		<ul class="piclist" style="width: 2484px; left: -1656px; position: relative; overflow: hidden; padding: 0px; margin: 0px;"> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>乡村发展</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>民风民俗</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>文化建设</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>吃喝玩乐</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>随想随写</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>乡村发展2</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>民风民俗2</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>文化建设2</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>吃喝玩乐2</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>随想随写2</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>乡村发展3</span></a></li> 
				      	<li><a href="" target="_blank"><img src="{{asset('img/3.jpg')}}" /><span>民风民俗3</span></a></li> 
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
.slideBox {
	width: 100%;
	height: 450px;
	overflow: hidden;
	position: relative;
	border: 1px solid #ddd;
}

.slideBox .hd {
	height: 15px;
	overflow: hidden;
	position: absolute;
	right: 5px;
	bottom: 5px;
	z-index: 1;
}

.slideBox .hd ul {
	overflow: hidden;
	zoom: 1;
	float: left;
	list-style: none;
}

.slideBox .hd ul li {
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

.slideBox .hd ul li.on {
	background: #3097d1;
}

.slideBox .bd {
	position: relative;
	height: 100%;
	z-index: 0;
}
.slideBox .bd ul{
	padding: 0;
}

.slideBox .bd li {
	zoom: 1;
	vertical-align: middle;
}

.slideBox .bd img {
	width: 100%;
	height: 450px;
	display: block;
}

.slideBox .prev, .slideBox .next {
	position: absolute;
	left: 3%;
	top: 50%;
	margin-top: -25px;
	display: block;
	width: 32px;
	height: 40px;
	background: url('{{asset('js/sliderShow/img/slider-arrow.png')}}') -110px 5px no-repeat;
	filter: alpha(opacity=50);
	opacity: 0.5;
}

.slideBox .next {
	left: auto;
	right: 3%;
	background-position: 8px 5px;
}

.slideBox .prev:hover,
		.slideBox .next:hover {
	filter: alpha(opacity=100);
	opacity: 1;
}

.slideBox .prevStop {
	display: none;
}

.slideBox .nextStop {
	display: none;
}
.popWrap {
	width: 100%;
	height: 200px;
	background: #fff;
}


    </style>
@stop

@section('scripts')
<script src="{{ asset('js/sliderShow/js/jquery.SuperSlide.2.1.3.js') }}" type="text/javascript"></script>
<script type="text/javascript">

	// 信息栏
	jQuery(".scrollBox").slide({ titCell:".list li", mainCell:".piclist", effect:"left",vis:4,scroll:4,delayTime:800,trigger:"click",easing:"easeOutCirc"});
	// 轮播图
	jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});

	function getCities() {
		$.ajax({
			url: '/getArea',
			data: {
				type: 'cities'
			},
			type: 'get',
			success: function(res) {
				if (res) {
					for (var i in res) {
						var id = res[i].id
						var items = '<li onclick="getCounties(\''+res[i].id+'\')">'+ '<a>' + '<span>' + res[i].name + '</span>' + '</a>' + '</li>'
						$('#cities').append(items)
					}
				}
			}
		})
	}
	getCities()
	function getCounties(d) {
		console.log(d);
		$.ajax({
			url: '/getArea',
			data: {
				type: 'counties',
				cities_pid: d
			},
			success: function(res) {
				console.log(res);
			} 
		})
	}
	$.ajax({
		url: '/',
		type: 'get',
		success: function(res) {
			// console.log(res);
		}
	})
</script>
@stop

