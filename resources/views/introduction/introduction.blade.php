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
            <p class="lead">short title</p>
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

@section('script')
<script type="text/javascript">
    // $(function () {
    //     // body...
    //     $('nav_li').each(function () {
    //         $(this).click(function(){
    //             console.log('ssss');
    //             $(this).addClass('active').siblings().removeClass('active'); 
    //         })
    //     })
    // })
      var elements = document.getElementsByClassName("nav_li");
        for(var i = 0;i < elements.length;i++){
            elements[i].onclick=function(){
                console.log('aaaaaaaa');
            };
        }
</script>
@stop