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
<aside id="sidebar-left" class="{{ $sidebarClass or 'sidebar-circle' }}">

    <!-- Start left navigation - profile shortcut -->
    <div class="sidebar-content">
        <div class="media">
            <a class="pull-left has-notif avatar" href="{{url('page/profile')}}">
                <i class="online"></i>
            </a>
            <div class="media-body">
                <h4 class="media-heading">Hello, <span></span></h4>
                <small>Web Designer</small>
            </div>
        </div>
    </div><!-- /.sidebar-content -->
    <!--/ End left navigation -  profile shortcut -->

    <!-- Start left navigation - menu -->
    <ul class="sidebar-menu">

        <!-- Start navigation - dashboard -->
        <li {!! Request::is('/') ? 'class="active"' : null !!}>
            <a href="{{url('/')}}">
                <span class="icon"><i class="fa fa-home"></i></span>
                <span class="text">Dashboard</span>
                {!! Request::is('/') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End navigation - dashboard -->


        <!-- Start category 基础数据 -->
        <li class="sidebar-category">
            <span>基础数据</span>
            <span class="pull-right"><i class="fa fa-trophy"></i></span>
        </li>
        <!--/ End category apps -->

        <!-- Start navigation - 国家/城市 -->
        <li {!! Request::is('nation','city','currency')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-globe"></i></span>
                <span class="text">国家/城市</span>
                <span class="arrow"></span>
                {!! Request::is('nation', 'city','currency') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('nation')? 'class="active"' : null !!}><a href="{{url('nation')}}">国家</a></li>
                <li {!! Request::is('city')? 'class="active"' : null !!}><a href="{{url('city')}}">城市</a></li>
                <li {!! Request::is('currency')? 'class="active"' : null !!}><a href="{{url('currency')}}">货币</a></li>
            </ul>
        </li>
        <!--/ End navigation - 国家/城市 -->

        <!-- Start navigation - 机票 -->
        <li {!! Request::is('airport','airport/*','airway','airway/*','airline','airline/*','flightticket','flightticket/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-ticket"></i></span>
                <span class="text">机票</span>
                <span class="arrow"></span>
                {!! Request::is('airport', 'airport/*','airway','airway/*','airline','airline/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('flightticket','flightticket/*')? 'class="active"' : null !!}><a href="{{url('flightticket')}}">机票统计</a></li>
                <li {!! Request::is('airport','airport/*')? 'class="active"' : null !!}><a href="{{url('airport')}}">机场</a></li>
                <li {!! Request::is('cityway','cityway/*')? 'class="active"' : null !!}><a href="{{url('cityway')}}">城市航线</a></li>
                <li {!! Request::is('airway','airway/*')? 'class="active"' : null !!}><a href="{{url('airway')}}">航线</a></li>
                <li {!! Request::is('airline','airline/*')? 'class="active"' : null !!}><a href="{{url('airline')}}">航空公司</a></li>
            </ul>
        </li>
        <!--/ End navigation - 机票 -->

        <!-- Start category 抓取数据 -->
        <li class="sidebar-category">
            <span>抓取数据</span>
            <span class="pull-right"><i class="fa fa-trophy"></i></span>
        </li>
        <!--/ End category apps -->

        <!-- Start navigation - blog -->
        <li {!! Request::is('tickettask','tasklog')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-tasks"></i></span>
                <span class="text">任务管理</span>
                <span class="arrow"></span>
                {!! Request::is('tickettask','tasklog') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('tickettask')? 'class="active"' : null !!}><a href="{{url('tickettask')}}">机票任务</a></li>
                <li {!! Request::is('tasklog')? 'class="active"' : null !!}><a href="{{url('tasklog')}}">定时日志</a></li>
            </ul>
        </li>
        <!--/ End navigation - blog -->

        <!-- Start navigation - blog -->
        <li {!! Request::is('nation','nation/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-globe"></i></span>
                <span class="text">日志</span>
                <span class="arrow"></span>
                {!! Request::is('request', 'request/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('request','request')? 'class="active"' : null !!}><a href="{{url('request')}}">日志</a></li>
                <li {!! Request::is('nation','nation/single')? 'class="active"' : null !!}><a href="{{url('nation/single')}}">Single</a></li>
            </ul>
        </li>
        <!--/ End navigation - blog -->

        <!-- Start category apps -->
        <li class="sidebar-category">
            <span>用户</span>
            <span class="pull-right"><i class="fa fa-trophy"></i></span>
        </li>
        <!--/ End category apps -->

        <!-- Start navigation - blog -->
        <li {!! Request::is('user','user/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-user"></i></span>
                <span class="text">用户</span>
                <span class="arrow"></span>
                {!! Request::is('user', 'user/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('user')? 'class="active"' : null !!}><a href="{{url('user')}}">用户管理</a></li>
            </ul>
        </li>
        <!--/ End navigation - blog -->

        <!-- Start navigation - mail -->
        <li {!! Request::is('mail','mail/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-envelope"></i></span>
                <span class="text">Mail</span>
                <span class="arrow"></span>
                {!! Request::is('mail', 'mail/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('mail','mail/inbox')? 'class="active"' : null !!}><a href="{{url('mail/inbox')}}">Inbox</a></li>
                <li {!! Request::is('mail','mail/compose')? 'class="active"' : null !!}><a href="{{url('mail/compose')}}">Compose mail</a></li>
                <li {!! Request::is('mail','mail/view')? 'class="active"' : null !!}><a href="{{url('mail/view')}}">View mail</a></li>
            </ul>
        </li>
        <!--/ End navigation - mail -->

        <!-- Start navigation - pages -->
        <li {!! Request::is('page','page/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Pages</span>
                <span class="arrow"></span>
                {!! Request::is('page', 'page/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('page','page/gallery')? 'class="active"' : null !!}><a href="{{url('page/gallery')}}">Gallery</a></li>
                <li {!! Request::is('page','page/faq')? 'class="active"' : null !!}><a href="{{url('page/faq')}}">FAQ <span class="label label-danger pull-right">New</span></a></li>
                {{--<li {!! Request::is('page','page/calendar')? 'class="active"' : null !!}><a href="{{url('page/calendar')}}">Calendar</a></li>--}}
                <li {!! Request::is('page','page/invoice')? 'class="active"' : null !!}><a href="{{url('page/invoice')}}">Invoice</a></li>
                <li {!! Request::is('page','page/messages')? 'class="active"' : null !!}><a href="{{url('page/messages')}}">Messages</a></li>
                <li {!! Request::is('page','page/timeline')? 'class="active"' : null !!}><a href="{{url('page/timeline')}}">Timeline</a></li>
                <li {!! Request::is('page','page/profile')? 'class="active"' : null !!}><a href="{{url('page/profile')}}">Profile</a></li>
                <li {!! Request::is('page','page/search-*')? 'class="submenu active"' : 'class="submenu"' !!}>
                    <a href="javascript:void(0);">Search<span class="arrow"></span></a>
                    <ul>
                        <li {!! Request::is('page','page/search-course')? 'class="active"' : null !!}><a href="{{url('page/search-course')}}">Courses</a></li>
                    </ul>
                </li>
                <li {!! Request::is('page','page/error-*')? 'class="submenu active"' : 'class="submenu"' !!}>
                    <a href="javascript:void(0);">Error <span class="arrow"></span></a>
                    <ul>
                        <li {!! Request::is('page','page/error-403')? 'class="active"' : null !!}><a href="{{url('page/error-403')}}">Error 403</a></li>
                        <li {!! Request::is('page','page/error-403-type-2')? 'class="active"' : null !!}><a href="{{url('page/error-403-type-2')}}">Error 403 Type 2</a></li>
                        <li {!! Request::is('page','page/error-404')? 'class="active"' : null !!}><a href="{{url('page/error-404')}}">Error 404</a></li>
                        <li {!! Request::is('page','page/error-404-type-2')? 'class="active"' : null !!}><a href="{{url('page/error-404-type-2')}}">Error 404 Type 2</a></li>
                        <li {!! Request::is('page','page/error-500')? 'class="active"' : null !!}><a href="{{url('page/error-500')}}">Error 500</a></li>
                        <li {!! Request::is('page','page/error-500-type-2')? 'class="active"' : null !!}><a href="{{url('page/error-500-type-2')}}">Error 500 Type 2</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);">Account <span class="arrow"></span></a>
                    <ul>
                        <li {!! Request::is('page','page/signin')? 'class="active"' : null !!}><a href="{{url('page/signin')}}">Sign In</a></li>
                        <li {!! Request::is('page','page/signintype2')? 'class="active"' : null !!}><a href="{{url('page/signintype2')}}">Sign In Type 2</a></li>
                        <li {!! Request::is('page','page/signup')? 'class="active"' : null !!}><a href="{{url('page/signup')}}">Sign Up</a></li>
                        <li {!! Request::is('page','page/lost-password')? 'class="active"' : null !!}><a href="{{url('page/lost-password')}}">Lost password</a></li>
                        <li {!! Request::is('page','page/lock-screen')? 'class="active"' : null !!}><a href="{{url('page/lock-screen')}}">Lock Screen</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <!--/ End navigation - pages -->

        <!-- Start category 系统管理-->
        <li class="sidebar-category">
            <span>系统管理</span>
            <span class="pull-right"><i class="fa fa-magic"></i></span>
        </li>
        <!--/ End category 系统管理-->

        <!-- Start navigation - 管理员 -->
        <li {!! Request::is('admin')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="{{url('admin')}}">
                <span class="icon"><i class="fa fa-users"></i></span>
                <span class="text">管理员</span>
                {!! Request::is('admin') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End navigation - 管理员 -->

        <!-- Start navigation - 角色 -->
        <li {!! Request::is('role')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="{{url('role')}}">
                <span class="icon"><i class="fa fa-user"></i></span>
                <span class="text">角色</span>
                {!! Request::is('role') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End navigation - 角色 -->

        <!-- Start navigation - 权限 -->
        <li {!! Request::is('permission')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="{{url('permission')}}">
                <span class="icon"><i class="fa fa-lock"></i></span>
                <span class="text">权限</span>
                {!! Request::is('permission') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End navigation - 权限 -->


        <!-- Start navigation - charts -->
        <li {!! Request::is('chart','chart/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-signal"></i></span>
                <span class="text">Charts</span>
                <span class="arrow"></span>
                {!! Request::is('chart', 'chart/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('chart','chart/flot')? 'class="active"' : null !!}><a href="{{url('chart/flot')}}">Flot</a></li>
                <li {!! Request::is('chart','chart/morris')? 'class="active"' : null !!}><a href="{{url('chart/morris')}}">Morris</a></li>
                <li {!! Request::is('chart','chart/chartjs')? 'class="active"' : null !!}><a href="{{url('chart/chartjs')}}">Chartjs</a></li>
                <li {!! Request::is('chart','chart/c3js')? 'class="active"' : null !!}><a href="{{url('chart/c3js')}}">C3js</a></li>
            </ul>
        </li>
        <!--/ End navigation - charts -->

        <!-- Start category development -->
        <li class="sidebar-category">
            <span>工具</span>
            <span class="pull-right"><i class="fa fa-code"></i></span>
        </li>
        <!--/ End category development -->

        <!-- Start development - components -->
        <li {!! Request::is('snatch','snatch/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-cube"></i></span>
                <span class="text">抓取</span>
                <span class="plus"></span>
                {!! Request::is('snatch', 'snatch/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('snatch','snatch/simRequest')? 'class="active"' : null !!}><a href="{{url('snatch/simRequest')}}">模拟请求</a></li>
                <li {!! Request::is('component','component/sliders')? 'class="active"' : null !!}><a href="{{url('component/sliders')}}">Sliders</a></li>
                <li {!! Request::is('component','component/icon/*')? 'class="submenu active"' : 'class="submenu"' !!}>
                    <a href="javascript:void(0);">
                        <span class="text">Icons</span>
                        <span class="count label label-danger">6</span>
                        <span class="arrow"></span>
                    </a>
                    <ul>
                        <li {!! Request::is('component','component/icon/glyphicons')? 'class="active"' : null !!}><a href="{{url('component/icon/glyphicons')}}">Glyphicons</a></li>
                        <li {!! Request::is('component','component/icon/glyphicons-pro')? 'class="active"' : null !!}><a href="{{url('component/icon/glyphicons-pro')}}">Glyphicons PRO</a></li>
                        <li {!! Request::is('component','component/font-awesome')? 'class="active"' : null !!}><a href="{{url('component/icon/font-awesome')}}">Font Awesome</a></li>
                        <li {!! Request::is('component','component/icon/weather-icons')? 'class="active"' : null !!}><a href="{{url('component/icon/weather-icons')}}">Weather Icons</a></li>
                        <li {!! Request::is('component','component/icon/map-icons')? 'class="active"' : null !!}><a href="{{url('component/icon/map-icons')}}">Map Icons</a></li>
                        <li {!! Request::is('component','component/icon/simple-line-icons')? 'class="active"' : null !!}><a href="{{url('component/icon/simple-line-icons')}}">Simple Line Icons</a></li>
                    </ul>
                </li>
                <li {!! Request::is('component','component/other')? 'class="active"' : null !!}><a href="{{url('component/other')}}">Other</a></li>
            </ul>
        </li>
        <!--/ End development - components -->

        <!-- Start development - layouts -->
        <li {!! Request::is('layout','layout/*')? 'class="submenu active"' : 'class="submenu"' !!}>
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-columns"></i></span>
                <span class="text">Layouts</span>
                <span class="plus"></span>
                {!! Request::is('layout', 'layout/*') ? '<span class="selected"></span>' : null !!}
            </a>
            <ul>
                <li {!! Request::is('layout','layout/blank')? 'class="active"' : null !!}><a href="{{url('layout/blank')}}">Blank Page</a></li>
                <li {!! Request::is('layout','layout/boxed')? 'class="active"' : null !!}><a href="{{url('layout/boxed')}}">Boxed Page</a></li>
                <li {!! Request::is('layout','layout/header-fixed')? 'class="active"' : null !!}><a href="{{url('layout/header-fixed')}}">Header Fixed Page</a></li>
                <li {!! Request::is('layout','layout/sidebar-fixed')? 'class="active"' : null !!}><a href="{{url('layout/sidebar-fixed')}}">Sidebar Fixed Page</a></li>
                <li {!! Request::is('layout','layout/sidebar-minimize')? 'class="active"' : null !!}><a href="{{url('layout/sidebar-minimize')}}">Sidebar Minimize Page</a></li>
                <li {!! Request::is('layout','layout/sidebar-default')? 'class="active"' : null !!}><a href="{{url('layout/sidebar-default')}}">Sidebar Default Page</a></li>
                <li {!! Request::is('layout','layout/sidebar-box')? 'class="active"' : null !!}><a href="{{url('layout/sidebar-box')}}">Sidebar Box Page</a></li>
                <li {!! Request::is('layout','layout/sidebar-rounded')? 'class="active"' : null !!}><a href="{{url('layout/sidebar-rounded')}}">Sidebar Rounded Page</a></li>
                <li {!! Request::is('layout','layout/sidebar-circle')? 'class="active"' : null !!}><a href="{{url('layout/sidebar-circle')}}">Sidebar Circle Page</a></li>
                <li {!! Request::is('layout','layout/footer-fixed')? 'class="active"' : null !!}><a href="{{url('layout/footer-fixed')}}">Footer Fixed Page</a></li>
            </ul>
        </li>
        <!--/ End development - layouts -->

    <!-- Start development - sub menu -->
    <li class="submenu">
        <a href="javascript:void(0);">
            <span class="icon"><i class="fa fa-align-left"></i></span>
            <span class="text">Sub Menu</span>
            <span class="plus"></span>
        </a>
        <ul>
            <!-- Start level 1 -->
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="text">Level 1</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <!-- Start level 2 -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="text">Level 2</span>
                            <span class="fa fa-angle-double-right pull-right arrow"></span>
                        </a>
                        <ul>
                            <!-- Start level 3 -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <span class="text">Level 3</span>
                                    <span class="fa fa-angle-double-right pull-right arrow"></span>
                                </a>
                                <ul>
                                    <!-- Start level 4 -->
                                    <li class="submenu">
                                        <a href="javascript:void(0);">
                                            <span class="text">Level 4</span>
                                            <span class="fa fa-angle-double-right pull-right arrow"></span>
                                        </a>
                                        <ul>
                                            <!-- Start level 5 -->
                                            <li>
                                                <a href="javascript:void(0);">Level 5</a>
                                            </li>
                                            <!--/ End level 5 -->
                                            <li>
                                                <a href="javascript:void(0);">Level 5</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Level 5</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!--/ End level 4 -->
                                    <li>
                                        <a href="javascript:void(0);">Level 4</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Level 4</a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ End level 3 -->
                            <li>
                                <a href="javascript:void(0);">Level 3</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Level 3</a>
                            </li>
                        </ul>
                    </li>
                    <!--/ End level 2 -->
                    <li>
                        <a href="javascript:void(0);">Level 2</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Level 2</a>
                    </li>
                </ul>
            </li>
            <!--/ End level 1 -->
            <li>
                <a href="javascript:void(0);">
                    <span class="text">Level 1</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <span class="text">Level 1</span>
                </a>
            </li>
        </ul>
    </li>
    <!--/ End development - sub menu -->

    <!-- Start development - animate.css -->
    <li {!! Request::is('animate', 'animate/index') ? 'class="active"' : null !!}>
        <a href="{{url('animate/index')}}">
            <span class="icon"><i class="fa fa-forumbee"></i></span>
            <span class="text">Animate.css</span>
            <span class="label label-danger pull-right">New</span>
            {!! Request::is('animate', 'animate/index') ? '<span class="selected"></span>' : null !!}
        </a>
    </li>
    <!--/ End development - animate.css -->

        <!-- Start category widget -->
        <li class="sidebar-category">
            <span>WIDGET</span>
            <span class="pull-right"><i class="fa fa-cubes"></i></span>
        </li>
        <!--/ End category widget -->

        <!-- Start widget - overview -->
        <li {!! Request::is('widget','widget/overview')? 'class="active"' : null !!}>
            <a href="{{url('widget/overview')}}">
                <span class="icon"><i class="fa fa-desktop"></i></span>
                <span class="text">Overview</span>
                <span class="label label-primary pull-right rounded">10</span>
                {!! Request::is('widget', 'widget/overview') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End widget - overview -->

        <!-- Start widget - social -->
        <li {!! Request::is('widget','widget/social')? 'class="active"' : null !!}>
            <a href="{{url('widget/social')}}">
                <span class="icon"><i class="fa fa-group"></i></span>
                <span class="text">Social</span>
                <span class="label label-success pull-right rounded">28</span>
                {!! Request::is('widget', 'widget/social') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End widget - social -->

        <!-- Start widget - blog -->
        <li {!! Request::is('widget','widget/blog')? 'class="active"' : null !!}>
            <a href="{{url('widget/blog')}}">
                <span class="icon"><i class="fa fa-pencil"></i></span>
                <span class="text">Blog</span>
                <span class="label label-info pull-right rounded">15</span>
                {!! Request::is('widget', 'widget/blog') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End widget - blog -->

        <!-- Start widget - weather -->
        <li {!! Request::is('widget','widget/weather')? 'class="active"' : null !!}>
            <a href="{{url('widget/weather')}}">
                <span class="icon"><i class="fa fa-sun-o"></i></span>
                <span class="text">Weather</span>
                <span class="label label-warning pull-right rounded">6</span>
                {!! Request::is('widget', 'widget/weather') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End widget - weather -->

        <!-- Start widget - misc -->
        <li {!! Request::is('widget','widget/misc')? 'class="active"' : null !!}>
            <a href="{{url('widget/misc')}}">
                <span class="icon"><i class="fa fa-puzzle-piece"></i></span>
                <span class="text">Misc</span>
                <span class="label label-danger pull-right rounded">9</span>
                {!! Request::is('widget', 'widget/misc') ? '<span class="selected"></span>' : null !!}
            </a>
        </li>
        <!--/ End widget - misc -->

        <!-- Start category documentation -->
        <li class="sidebar-category">
            <span><span class="hidden-sidebar-minimize">BLANKON</span> CORE</span>
            <span class="pull-right"><i class="fa fa-coffee"></i></span>
        </li>
        <!--/ End category documentation -->

        <!-- Start documentation - api documentation -->
        <li>
            <a href="../../../../../documentation/admin/laravel/live-preview-documentation.html" target="_blank">
                <span class="icon"><i class="fa fa-book"></i></span>
                <span class="text">API Documentation</span>
            </a>
        </li>
        <!--/ End documentation - api documentation -->

    </ul><!-- /.sidebar-menu -->
    <!--/ End left navigation - menu -->

    <!-- Start left navigation - footer -->
    <div class="sidebar-footer hidden-xs hidden-sm hidden-md">
        <a id="setting" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Setting"><i class="fa fa-cog"></i></a>
        <a id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
        <a id="lock-screen" data-url="lock-screen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Lock Screen"><i class="fa fa-lock"></i></a>
        <a id="logout" data-url="signin" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Logout"><i class="fa fa-power-off"></i></a>
    </div><!-- /.sidebar-footer -->
    <!--/ End left navigation - footer -->

</aside><!-- /#sidebar-left -->
<!--/ END SIDEBAR LEFT -->
