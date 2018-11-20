@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading login_title">村村汇</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}" style="width: 65%; margin: 0 auto;">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="">
                                <input id="email" type="email" class="control" name="email" value="{{ old('email') }}" required autofocus placeholder="请输入邮箱">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-top: 30px;">

                            <div class="">
                                <input id="password" type="password" class="control" name="password" required placeholder="请输入密码">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="">
                                <a class="btn btn-link login_forget" href="{{ route('password.request') }}">
                                    忘记密码？
                                </a>
                                <button type="submit" class="btn btn-primary login_btn">
                                    登录
                                </button>

                                
                            </div>
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
        .login_btn{
            width: 100%;
            margin-top: 30px;
            height: 40px;
            background-color: #0084ff;
            border-color: #0084ff;
        }
        .login_btn:hover{
            background-color: #0077e6;
            border-color: #0077e6;
        }
        .login_forget{
            color: #555555;
            text-decoration: none;
        }
    </style>
@stop
