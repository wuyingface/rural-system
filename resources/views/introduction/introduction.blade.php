@extends('layouts.app')



@section('content')
  <div class="container row">
    <div class="col-md-9 col-md-push-3">
        <div class="introduct_header">
            <div class="jumbotron">
                <h1>村名</h1>
            </div>
        </div>
        <div class="introduct_list row" style="padding-left: 15px;">
            <ul class="list-group col-md-6">
                <?php
                    $lists = ['行政区类别', '所属地区', '邮政编码', '地理位置', '面积']
                    ?>
                @foreach ($lists as $list)
                <li class="list-group-item">{{$list}}：</li>
                @endforeach
            </ul>
            <ul class="list-group col-md-6">
                <?php
                    $lists = ['人口', '气候', '特色产业', '著名景点', '方言']
                    ?>
                @foreach ($lists as $list)
                <li class="list-group-item">{{$list}}：</li>
                @endforeach
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
                $navs = ['人文', '风情', '吃喝', '发展']
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
                $('#detailTitle').html($(this).find('a').html())
            })
        })
    })
</script>
@stop