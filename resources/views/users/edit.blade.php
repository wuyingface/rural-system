@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
            </h4>
        </div>

        @include('common.error')

        <div class="panel-body">

            <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name-field">用户名</label>
                    <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" />
                </div>
                <div class="form-group">
                    <label for="email-field">邮 箱</label>
                    <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" />
                </div>
                <div class="form-group">
                    <label for="introduction-field">个人简介</label>
                    <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                </div>
                <div class="form-group">

                    <label for="" class="avatar-label">用户头像</label>
                    <a href="javascript:;" class="file">
                        选择文件
                        <input type="file" name="avatar" id="file" onchange="showPic(this)" class="btn btn-default">
                    </a>
                    

                    @if($user->avatar)
                        <!-- <br> -->
                        <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" id="preview" />
                    @endif

                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style type="text/css">
    .file {
    position: relative;
    width: 100px;
    display: block;
    background: #3097D1;
    border: 1px solid #2a88bd;
    border-radius: 4px;
    padding: 4px 12px;
    overflow: hidden;
    color: #fff;
    text-decoration: none;
    text-indent: 0;
    line-height: 20px;
    text-align: center;
}
.file input {
    position: absolute;
    font-size: 100px;
    right: 0;
    top: 0;
    opacity: 0;
}
.file:hover {
    background: #2579a9;
    border-color: #1f648b;
    color: #fff;
    text-decoration: none;
}
</style>
@stop

@section('scripts')
<script type="text/javascript">
    function showPic(img) {
        document.getElementById("preview").src = window.URL.createObjectURL(img.files[0])
    }
</script>
@stop