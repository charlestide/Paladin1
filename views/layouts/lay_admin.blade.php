<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework. Included are multiple example pages, elements styles, and javascript widgets to get your project started.">
        <meta name="keywords" content="admin, admin template, bootstrap3, clean, fontawesome4, good documentation, lightweight admin, responsive dashboard, webapp">
        <meta name="author" content="Djava UI">
        <title>Dashboard of {{config('app.name')}}</title>
        <!--/ END META SECTION -->

        <!-- START @FAVICONS -->
        <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-144x144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
        <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-114x114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
        <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-72x72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
        <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-57x57-precomposed.png" rel="apple-touch-icon-precomposed">
        <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon.png" rel="shortcut icon">
        <!--/ END FAVICONS -->

        <!-- START @FONT STYLES -->
        <link href="https://fonts.cat.net/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <link href="https://fonts.cat.net/css?family=Oswald:700,400" rel="stylesheet">
        <!--/ END FONT STYLES -->


        {{--jquery--}}
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

        {{--bootscrip--}}
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        {{--fot-awesome--}}
        <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        {{--animate--}}
        <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">

        {{--fuelux--}}
        <link href="https://cdn.bootcss.com/fuelux/3.16.1/css/fuelux.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/fuelux/3.16.1/js/fuelux.min.js"></script>

        {{--toastr--}}
        <link href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" type="text/css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

        {{--jquery-cookie--}}
        <script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

        {{--handlebars--}}
        <script src="https://cdn.bootcss.com/handlebars.js/4.0.10/handlebars.min.js"></script>

        {{--typeahead--}}
        <script src="https://cdn.bootcss.com/typeahead.js/0.11.1/bloodhound.min.js"></script>

        <script src="https://cdn.bootcss.com/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdn.bootcss.com/soundmanager2/2.97a.20170601/script/soundmanager2-nodebug-jsmin.js"></script>
        <script src="https://cdn.bootcss.com/bootbox.js/4.4.0/bootbox.min.js"></script>
        <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <script src="https://cdn.bootcss.com/dropzone/5.1.1/min/dropzone.min.js"></script>
        <script src="https://cdn.bootcss.com/flot/0.8.3/jquery.flot.min.js"></script>
        <script src="https://cdn.bootcss.com/flot/0.8.3/jquery.flot.categories.min.js"></script>
        <script src="https://cdn.bootcss.com/flot/0.8.3/jquery.flot.resize.min.js"></script>

        <script src="https://cdn.bootcss.com/flot/0.8.3/jquery.flot.pie.min.js"></script>

        {{--jquery-confirm--}}
        <link href="https://cdn.bootcss.com/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>


        {{--<script src="https://cdn.bootcss.com/underscore.js/1.8.3/underscore-min.js"></script>--}}
        {{--<script src="https://cdn.bootcss.com/pleasejs/0.4.2/Please.min.js"></script>--}}
        <script src="https://cdn.bootcss.com/skycons/1396634940/skycons.min.js"></script>
        <script src="https://cdn.bootcss.com/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery-mockjax/1.6.2/jquery.mockjax.min.js"></script>
        {{--<script src="https://cdn.bootcss.com/moment.js/2.18.1/locale/zh-cn.js"></script>--}}
        {{--<script src="https://cdn.bootcss.com/echarts/3.7.2/echarts.min.js"></script>--}}
        {{--<script src="/js/components/echarts/themes/macarons.js"></script>--}}
        <script src="https://cdn.bootcss.com/vue/2.5.13/vue.js"></script>
        <link href="https://cdn.bootcss.com/select2/4.0.4/css/select2.min.css" rel="stylesheet">

        <link href="https://cdn.bootcss.com/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>

        <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment.min.js"></script>
    {{--<link href="https://cdn.bootcss.com/chosen/1.8.2/chosen.min.css" rel="stylesheet">--}}

        {{--<link href="https://cdn.bootcss.com/dropzone/5.1.1/min/dropzone.min.css" rel="stylesheet">--}}

        {{--paladin--}}
        <link href="{{asset('/paladin/css/paladin.css')}}" rel="stylesheet">
        <link href="{{asset('/paladin/css/themes/laravel.theme.css')}}" id="theme" rel="stylesheet">
        <link href="https://at.alicdn.com/t/font_527081_hpb7nmm7vd706bt9.css" rel="stylesheet">
    <!--/ END PAGE LEVEL SCRIPTS -->


        <!--/ END JAVASCRIPT SECTION -->
    </head>
    <!--/ END HEAD -->

    <!--

    |=========================================================================================================================|
    |  TABLE OF CONTENTS (Use search to find needed section)                                                                  |
    |=========================================================================================================================|
    |  01. @HEAD                        |  Container for all the head elements                                                |
    |  02. @META SECTION                |  The meta tag provides metadata about the HTML document                             |
    |  03. @FAVICONS                    |  Short for favorite icon, shortcut icon, website icon, tab icon or bookmark icon    |
    |  04. @FONT STYLES                 |  Font from google fonts                                                             |
    |  05. @GLOBAL MANDATORY STYLES     |  The main 3rd party plugins css file                                                |
    |  06. @PAGE LEVEL STYLES           |  Specific 3rd party plugins css file                                                |
    |  07. @THEME STYLES                |  The main theme css file                                                            |
    |  08. @IE SUPPORT                  |  IE support of HTML5 elements and media queries                                     |
    |=========================================================================================================================|
    |  09. @BODY                        |  Contains all the contents of an HTML document                                      |
    |  10. @WRAPPER                     |  Wrapping page section                                                              |
    |  11. @HEADER                      |  Header page section contains about logo, top navigation, notification menu         |
    |  12. @SIDEBAR LEFT                |  Sidebar page section contains all sidebar menu left                                |
    |  13. @PAGE CONTENT                |  Contents page section contains breadcrumb, content page, footer page               |
    |  14. @SIDEBAR RIGHT               |  Sidebar page section contains all sidebar menu right                               |
    |  15. @BACK TOP                    |  Element back to top and action                                                     |
    |=========================================================================================================================|
    |  16. @CORE PLUGINS                |  The main 3rd party plugins script file                                             |
    |  17. @PAGE LEVEL PLUGINS          |  Specific 3rd party plugins script file                                             |
    |  18. @PAGE LEVEL SCRIPTS          |  The main theme script file                                                         |
    |=========================================================================================================================|

    START @BODY
    |=========================================================================================================================|
	|  TABLE OF CONTENTS (Apply to body class)                                                                                |
	|=========================================================================================================================|
    |  01. page-boxed                   |  Page into the box is not full width screen                                         |
	|  02. page-header-fixed            |  Header element become fixed position                                               |
	|  03. page-sidebar-fixed           |  Sidebar element become fixed position with scroll support                          |
	|  04. page-sidebar-minimize        |  Sidebar element become minimize style width sidebar                                |
	|  05. page-footer-fixed            |  Footer element become fixed position with scroll support on page content           |
	|  06. page-sound                   |  For playing sounds on user actions and page events                                 |
	|=========================================================================================================================|

	-->
    <body class="page-session page-sound page-header-fixed page-sidebar-fixed">

        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- START @WRAPPER -->
        <section id="wrapper">

            <!-- START @HEADER -->
            	@include('paladin::layouts._header')
            <!--/ END HEADER -->

            <!--

            START @SIDEBAR LEFT
            |=========================================================================================================================|
            |  TABLE OF CONTENTS (Apply to sidebar left class)                                                                        |
            |=========================================================================================================================|
            |  01. sidebar-box               |  Variant style sidebar left with box icon                                              |
            |  02. sidebar-rounded           |  Variant style sidebar left with rounded icon                                          |
            |  03. sidebar-circle            |  Variant style sidebar left with circle icon                                           |
            |=========================================================================================================================|

            -->
            	@include('paladin::layouts._sidebar_left')
            <!--/ END SIDEBAR LEFT -->

            <section id="page-content">

                <div id="page-inner">
                    <!-- START @PAGE CONTENT -->
                        @yield('content')
                    <!--/ END PAGE CONTENT -->
                </div>

                <!-- Start footer content -->
                @include('paladin::layouts._footer-admin')
                <!--/ End footer content -->

            </section><!-- /#page-content -->

            <!-- START @SIDEBAR RIGHT -->
            	@include('paladin::layouts._sidebar_right')
            <!--/ END SIDEBAR RIGHT -->

        </section><!-- /#wrapper -->

        <!--/ END WRAPPER -->

        <script src="//at.alicdn.com/t/font_527081_hpb7nmm7vd706bt9.js"></script>
        <script type="text/javascript" src="/paladin/js/blankon.js"></script>
        <script type="text/javascript" src="{{asset('/paladin/js/app.js')}}"></script>
        @stack('scripts')
        <script type="text/javascript">
            if (typeof(window.content) === 'undefined') {
                console.log('没定义呀');
                window.content = new Vue({
                    el: '#page-inner',
                });
            }
        </script>

        <!-- START @BACK TOP -->
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div><!-- /#back-top -->
        <!--/ END BACK TOP -->

        @if(session('tip'))
            <div id="tip" status="{{session('tipStatus') ?: 'success'}}" style="display: none;">{{session('tip')}}</div>
        @endif

        @if(count($errors))
            <div id="errors">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        @endif

    </body>
    <!--/ END BODY -->

</html>