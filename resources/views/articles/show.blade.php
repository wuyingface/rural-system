@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->excerpt)

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    作者：{{ $article->user->name }}
                </div>
                <hr>
                <div class="media">
                    <div align="center">
                        <a href="{{ route('users.show', $article->user->id) }}">
                            <img class="thumbnail img-responsive" src="{{ $article->user->avatar }}" width="300px" height="300px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 article-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">
                    {{ $article->title }}
                </h1>

                <div class="article-meta text-center">
                    {{ $article->created_at->diffForHumans() }}
                    
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    {{ $article->reply_count }}
                </div>
                
                <!-- 位置坐标 -->
                <div class="row" style="margin-top: 20px;">
                  <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <a href="javascript:void(0);" id="position" >无锡市江阴市华西村风景区</a>
                            <!-- 坐标 -->
                            <span style="display: none;" id="coordinate">{{$article -> map}}</span>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                   <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="map" style="height: 200px;"></div>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="article-body">
                    {!! $article->body !!}
                </div>

                @can('update', $article)
                    <div class="operate">
                        <hr>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default btn-xs pull-left" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑
                        </a>

                        <form action="{{ route('articles.destroy', $article->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                <i class="glyphicon glyphicon-trash"></i>
                                删除
                            </button>
                        </form>
                    </div>
                @endcan

            </div>
        </div>

        {{-- 用户回复列表 --}}
        <div class="panel panel-default article-reply">
            <div class="panel-body">
                @includeWhen(Auth::check(),'articles._reply_box', ['article' => $article])
                @include('articles._reply_list', ['replies' => $article->replies()->with('user', 'article')->get()])
            </div>
        </div>

    </div>
</div>
@stop

@section('styles')
    <style>    
    /*去掉logo标签*/
    .BMap_cpyCtrl, .anchorBL{
        display:none;
    }
    .panel{
        margin-bottom: 0;
    }
    </style>
@stop

@section('scripts')
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=7OOvPVfFtq8vZEUZn1Zv5Q7W4ndE4g0H"></script>
    <script type="text/javascript">
        var coordinate = $('#coordinate').html()
        var map = new BMap.Map('map');  
        var point = new BMap.Point(120.439879, 31.839665);
        map.centerAndZoom(point, 15); 
        map.enableScrollWheelZoom(true);
    </script>
@stop

