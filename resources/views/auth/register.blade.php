@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading login_title">村村汇</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" style="width: 65%;margin: 0 auto;">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <!-- <label for="name" class="col-md-4 control-label">用户名</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="name" type="text" class="control" name="name" value="{{ old('name') }}" required autofocus placeholder="请输入用户名">

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
                                <input id="email" type="email" class="control" name="email" value="{{ old('email') }}" placeholder="请输入邮箱地址" required>

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
                                <input id="password" type="password" class="control" name="password" placeholder="请输入密码" required>

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
                                <input id="password-confirm" type="password" class="control" name="password_confirmation" placeholder="请再次输入密码" required>
                            <!-- </div> -->
                        </div>

                        <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <!-- <label for="captcha" class="col-md-4 control-label">验证码</label> -->

                            <!-- <div class="col-md-6"> -->
                                <input id="captcha" class="control" name="captcha" placeholder="请输入验证码" >

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
                                <button type="submit" class="btn btn-primary register_btn" style="">
                                    注册 
                                    <i class="glyphicon glyphicon-arrow-right"></i>
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

@section('styles')
    <style>
        .login_title{
            font-size: 46px;
            text-align: center;
            color: #0084ff !important;
            padding-top: 20px;
        }
        .panel-default > .panel-heading{
            border: none;
        }
        .panel-default{
            border: none;
        }
        .control{
            box-shadow: none;
            border: none;
            border-bottom: 1px solid #ddd;
            outline: none;
            height: 46px;
            display: block;
            width: 100%;
            padding: 6px 12px;
            font-size: 16px;
            color: #555555;
            background-color: #fff;
        }
        .register_btn{
            width: 100%;
            margin-top: 30px;
            height: 40px;
            background-color: #0084ff;
            border-color: #0084ff;
        }
        .register_btn:hover{
            background-color: #0077e6;
            border-color: #0077e6;
        }
        .login_forget{
            color: #555555;
            text-decoration: none;
        }
    </style>
@stop
