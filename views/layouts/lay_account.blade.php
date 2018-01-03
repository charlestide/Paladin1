<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="{{config('locale')}}"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework. Included are multiple example pages, elements styles, and javascript widgets to get your project started.">
        <meta name="keywords" content="admin, admin template, bootstrap3, clean, fontawesome4, good documentation, lightweight admin, responsive dashboard, webapp">
        <meta name="author" content="Djava UI">
        <title>{{config('name')}}</title>
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
        <!--/ END FONT STYLES -->


        <!-- START @GLOBAL MANDATORY STYLES -->
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/dropzone/5.1.1/min/dropzone.min.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/fuelux/3.16.1/css/fuelux.min.css" rel="stylesheet">
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link href="/paladin/css/paladin.css" type="text/css" rel="stylesheet">
        <link href="/paladin/css/sign.css" rel="stylesheet">
        <link href="{{asset('/paladin/css/themes/laravel.theme.css')}}" id="laravel" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
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
	|  10. @LOADING ANIMATION           |  Loading animation when the page reload                                             |
	|  11. @WRAPPER                     |  Wrapping page section                                                              |
	|  12. @SIGN WRAPPER                |  Wrapping sign design                                                               |
	|=========================================================================================================================|
	|  13. @CORE PLUGINS                |  The main 3rd party plugins script file                                             |
	|  14. @PAGE LEVEL SCRIPTS          |  The main theme script file                                                         |
	|=========================================================================================================================|

    START @BODY
    |=========================================================================================================================|
	|  TABLE OF CONTENTS (Apply to body class)                                                                                |
	|=========================================================================================================================|
    |  01. page-boxed                   |  Page into the box is not full width screen                                         |
	|  02. page-sound                   |  For playing sounds on user actions and page events                                 |
	|=========================================================================================================================|

	-->
    <body class="page-sound laravel">
        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- START @SIGN WRAPPER -->
		@yield('content')
        <!--/ END SIGN WRAPPER -->

 	<!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/underscore.js/1.8.3/underscore-min.js"></script>
        <script src="https://cdn.bootcss.com/vue/2.5.9/vue.js"></script>
        {{--<script src="/js/app.js"></script>--}}

        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL PLUGINS -->
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        {{--<script type="text/javascript" src="/blankon/admin/js/blankon.sign.js"></script>--}}
        <script type="text/javascript" src="/paladin/js/form.js"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->


        <script type="text/javascript">
            const app = new Vue({
                el: '#sign-wrapper'
            });
        </script>

        <!--/ END JAVASCRIPT SECTION -->


    </body>
    <!-- END BODY -->

</html>
