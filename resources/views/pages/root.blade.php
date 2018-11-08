@extends('layouts.app')
@section('title')

@section('content')
  <div class="container">
  	<!-- 头部搜索 -->
  	<div class="page-header">
  		<h1>欢迎来到村村汇</h1>
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
		<div class="outBox" style="margin:0 auto">

			<div class="hd">
				<ul>
					<?php
                    	$citys = ['广州市', '深圳市', '珠海市', '佛山市', '惠州市']
                    ?>
                	@foreach ($citys as $city)
					<li>{{$city}}</li>
					@endforeach
				</ul>
			</div>

			<div class="tempWrap" style="overflow:hidden; position:relative;margin-left: 175px;">
				<div class="bd" style="left: 0px; position: relative; overflow: hidden; padding: 0px; margin: 0px;">
					<!-- inBox S -->
					<div class="inBox" style="float: left;">
						<div class="inHd">
							<ul><li class="on">栏目一</li><li>栏目二</li><li>栏目三</li></ul>
						</div>
						<div class="inBd">
							<ul>
								<li><img src="{{asset('img/1.jpg')}}" alt=""></li>
							</ul>
							<ul style="display: none;">
								<li><img src="{{asset('img/2.jpg')}}" alt=""></li>
							</ul>
							<ul style="display: none;">
								<li><img src="{{asset('img/3.jpg')}}" alt=""></li>
							</ul>
						</div>
					</div>
					
					<!-- inBox S -->
					<div class="inBox" style="float: left;">
						<div class="inHd">
							<ul style="text-align: center;"><li class="on">栏目三</li><li>栏目四</li><li>栏目五</li></ul>
						</div>
						<div class="inBd">
							<ul>
								<li><img src="{{asset('img/4.jpg')}}" alt=""></li>
							</ul>
							<ul style="display: none;">
								<li><img src="{{asset('img/5.jpg')}}" alt=""></li>
							</ul>
							<ul style="display: none;">
								<li><img src="{{asset('img/6.jpg')}}" alt=""></li>
							</ul>
						</div>
					</div>
					
					<!-- inBox S -->
					<div class="inBox" style="float: left;">
						<div class="inHd">
							<ul><li class="on">栏目六</li><li>栏目七</li><li>栏目八</li></ul>
						</div>
						<div class="inBd">
							<ul>
								<li><img src="{{asset('img/1.jpg')}}" alt=""></li>
							</ul>
							<ul style="display: none;">
								<li><img src="{{asset('img/2.jpg')}}" alt=""></li>
							</ul>
							<ul style="display: none;">
								<li><img src="{{asset('img/3.jpg')}}" alt=""></li>
							</ul>
						</div>
					</div>

				</div>

 		 	</div>
		</div>
	</div>

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
@stop

@section('scripts')
<script src="{{ asset('js/sliderShow/jquery.SuperSlide.2.1.3.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	/* 内层inBox渐显切换，注意titCell、mainCell等不能与外层相同 */
	jQuery(".inBox").slide({ titCell:".inHd li",mainCell:".inBd" });
	/* 外层outBox左滚动切换 */
	jQuery(".outBox").slide({ effect:"left"});


	jQuery(".scrollBox").slide({ titCell:".list li", mainCell:".piclist", effect:"left",vis:4,scroll:4,delayTime:800,trigger:"click",easing:"easeOutCirc"});
</script>
@stop

