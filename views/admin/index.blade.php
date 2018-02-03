<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{config('app.locale')}}" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="{{config('app.locale')}}" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="{{config('app.locale')}}"> <!--<![endif]-->
<head>
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('/css/element.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap4.css')}}">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    {{--<link href="{{asset('/paladin/css/theme.css')}}" id="theme" rel="stylesheet">--}}
</head>
<body>
    <div id="app">
        <router-view />
    </div>
</body>
{{--<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}

<script src="/js/vendor.js"></script>
<script src="/js/vue.js"></script>
<script src="/js/admin.js"></script>

</html>