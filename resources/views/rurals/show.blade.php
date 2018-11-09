@extends('layouts.app')



@section('content')
  <div class="container row">
    <div class="col-md-9 col-md-push-3">
        <div class="introduct_header">
            <div class="jumbotron">
                <h1>{{$rural -> name}}</h1>
                @can('update', $rural)
                <p>
                    <a href="{{ route('rurals.edit', $rural->id) }}" class="btn btn-primary" role="button" style="float: right;">编辑</a>
                </p>
                @endcan
            </div>
        </div>
        <div class="introduct_list row" style="padding-left: 15px;" id="introduct_list">
            <ul class="list-group col-md-6">
                <li class="list-group-item">别名： {{$rural -> alias}}</li>
                <li class="list-group-item">行政规划： {{$rural -> city}}{{$rural -> county}}{{$rural -> town}}</li>
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
        <div class="container">
            <p class="lead" id="detailTitle">人文</p>
            <p>
                something detail...
            </p>
        </div>
    </div>
    <div class="col-md-3 col-md-pull-9">
        <ul class="nav nav-pills nav-stacked">
            <?php
                $navs = ['概况', '乡村发展', '民风民俗', '文化建设', '吃喝玩乐', '随想随写']
                ?>
            @foreach ($navs as $nav)
            <li class="nav_li"><a href="#">{{$nav}}</a></li>
            @endforeach
        </ul>
    </div>
  </div>
@endsection

@section('scripts')
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
            $('#introduct_list').show()
        })
        $('.nav_li:not(:first)').each(function () {
            $(this).click(function() {
                $('#introduct_list').hide()
                $('#detailTitle').html($(this).find('a').html())
            })
        })
    })
</script>
@stop