@extends('layouts.app')

@section('title', isset($articleCategory) ? $articleCategory->name : '文章列表')

@section('content')

<div class="row">
    <div class="col-lg-9 col-md-9 article-list">
        @if (isset($articleCategory))
            <div class="alert alert-info" role="alert">
                {{ $articleCategory->name }} ：{{ $articleCategory->description }}
            </div>
        @endif
        <div class="panel panel-default">

            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class="{{ active_class( ! if_query('order', 'recent') ) }}"><a href="{{ Request::url() }}?order=default">最后回复</a></li>
                    <li class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent">最新发布</a></li>
                </ul>
            </div>

            <div class="panel-body">
                {{-- 文章列表 --}}
                @include('articles._article_list', ['articles' => $articles])
                {{-- 分页 --}}
                {!! $articles->appends(Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        @include('articles._sidebar')
    </div>
</div>

@endsection