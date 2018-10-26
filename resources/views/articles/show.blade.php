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
                    ⋅
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    {{ $article->reply_count }}
                </div>

                <div class="article-body">
                    {!! $article->body !!}
                </div>

                <div class="operate">
                    <hr>
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default btn-xs" role="button">
                        <i class="glyphicon glyphicon-edit"></i> 编辑
                    </a>
                    <a href="#" class="btn btn-default btn-xs" role="button">
                        <i class="glyphicon glyphicon-trash"></i> 删除
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@stop
