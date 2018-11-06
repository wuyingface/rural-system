@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">用户注册</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" style="width: 50%;margin: 0 auto;">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <!-- <label for="name" class="col-md-4 control-label">用户名</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="请输入用户名">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!-- <label for="email" class="col-md-4 control-label">邮箱地址</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="请输入邮箱地址" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!-- <label for="password" class="col-md-4 control-label">密 码</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="password" type="password" class="form-control" name="password" placeholder="请输入密码" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <!-- <label for="password-confirm" class="col-md-4 control-label">重复密码</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="请再次输入密码" required>
                            <!-- </div> -->
                        </div>

                        <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <!-- <label for="captcha" class="col-md-4 control-label">验证码</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="captcha" class="form-control" name="captcha" placeholder="请输入验证码" >

                                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <!-- <div class="col-md-6 col-md-offset-4"> -->
                                <button type="submit" class="btn btn-primary" style="width: 30%; position: relative; left: 50%; margin-left: -15%;">
                                    注册 <i class="glyphicon glyphicon-arrow-right"></i>
                                </button>
                            <!-- </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection