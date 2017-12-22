@extends('layouts.lay_account')

<!-- START @SIGN WRAPPER -->
@section('content')
    <div id="sign-wrapper">

        <!-- Brand -->
        <div class="brand">
            <img src="{{asset('/logo.png')}}" width="300" height="86" alt="brand logo"/>
        </div>
        <!--/ Brand -->

        <!-- Login form -->
        <form class="sign-in form-horizontal shadow rounded no-overflow" action="{{route('login')}}" method="post">
            {{ csrf_field() }}
            <div class="sign-header">
                <div class="form-group">
                    <div class="sign-text">
                        <span>DiffEarth 管理后台</span>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.sign-header -->
            <div class="sign-body">
                {{--<div class="form-group">--}}
                    {{--<div class="input-group input-group-lg rounded no-overflow">--}}
                        {{--<input type="text" class="form-control input-sm" placeholder="Username or email " name="email" value="{{old('email')}}">--}}
                        {{--<span class="input-group-addon"><i class="fa fa-user"></i></span>--}}
                    {{--</div>--}}
                {{--</div><!-- /.form-group -->--}}
                <pvc-input name="email" placeholder="用户名" size="lg" icon="user" value="{{old('email')}}"></pvc-input>
                <pvc-input name="password" placeholder="密码" size="lg" icon="lock" password="true"></pvc-input>
            </div><!-- /.sign-body -->
            <div class="sign-footer">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="ckbox ckbox-theme">
                                <input id="remember" type="checkbox" name="remember">
                                <label for="remember" class="rounded">记住我</label>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{url('lost-password')}}" title="lost password">忘记密码?</a>
                        </div>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded" id="login-btn">登陆</button>
                </div><!-- /.form-group -->
            </div><!-- /.sign-footer -->
        </form><!-- /.form-horizontal -->
        <!--/ Login form -->

        <!-- Content text -->
        <p class="text-muted text-center sign-link">需要帐号? <a href="{{url('register')}}"> 注册</a></p>
        <!--/ Content text -->

    </div><!-- /#sign-wrapper -->

@stop
<!--/ END SIGN WRAPPER -->
