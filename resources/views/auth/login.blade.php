@extends('paladin::layouts.lay_account')

<!-- START @SIGN WRAPPER -->
@section('content')
    <div id="sign-wrapper">

        <!-- Brand -->
        <div class="brand">
            <img src="{{asset('/paladin/logo.png')}}" width="300" height="86" alt="brand logo"/>
        </div>
        <!--/ Brand -->


        <!-- Login form -->
        <form class="sign-in form-horizontal shadow rounded no-overflow" action="{{route('login')}}" method="post">
            {{ csrf_field() }}
            <div class="sign-header">
                <div class="form-group">
                    <div class="sign-text">
                        <span>{{config('app.name')}} {{__('管理后台')}}</span>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.sign-header -->
            <div class="sign-body">
                <pvc-textfield name="name" placeholder="用户名" size="lg" icon="user" iconpos="right" layout="none" value="{{old('email')}}"></pvc-textfield>
                <pvc-textfield name="password" type="password" placeholder="密码" size="lg" icon="lock" iconpos="right" layout="none" password="true"></pvc-textfield>
            </div><!-- /.sign-body -->
            <div class="sign-footer">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="ckbox ckbox-theme">
                                <input id="remember" type="checkbox" name="remember">
                                <label for="remember" class="rounded">{{__('记住我')}}</label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded" id="login-btn">{{__('登陆')}}</button>
                </div><!-- /.form-group -->
            </div><!-- /.sign-footer -->
        </form><!-- /.form-horizontal -->
        <!--/ Login form -->
    </div><!-- /#sign-wrapper -->

@stop

<!--/ END SIGN WRAPPER -->
