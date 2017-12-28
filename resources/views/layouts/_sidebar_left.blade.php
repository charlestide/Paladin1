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

        @foreach(\App\Model\Menu::where('parent_id',0)->get() as $menu)
        <!-- Start category {{$menu->name}} -->
        <li class="sidebar-category">
            <span>{{$menu->name}}</span>
            <span class="pull-right"><i class="fa fa-{{$menu->icon}}"></i></span>
        </li>
        <!--/ End category {{$menu->name}} -->

        @foreach($menu->children as $submenu)
        <!-- Start navigation - {{$submenu->name}} -->
        <li class="submenu {!! Request::is(trim($submenu->url,'/'),trim($submenu->url,'/').'/*') ? 'active' : '' !!}">
            <a href="{!! $submenu->url ?: 'javascript:void(0);' !!}">
                <span class="icon"><i class="fa fa-{{$submenu->icon}}"></i></span>
                <span class="text">{{$submenu->name}}</span>
                @if($submenu->children->count())
                <span class="arrow"></span>
                @endif
                @if (Request::is(trim($submenu->url,'/'),trim($submenu->url,'/').'/*'))
                <span class="selected"></span>
                @endif
            </a>
            @if($submenu->children->count())
            <ul>
                @foreach($submenu->children as $littleMenu)
                <li class="little-menu {!!  Request::is('generator/*') ? 'active' : '' !!} ">
                    <a href="{{url($littleMenu->url)}}">{{$littleMenu->name}}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach

        <!--/ End navigation - {{$submenu->name}} -->
        @endforeach

        <script type="text/javascript">
            $('li.little-menu').parents('li.submenu').removeClass('active');
            $('li.little-menu.active').parents('li.submenu').addClass('active');
            $('li.little-menu.active').parents('li.submenu').children('a').append('<span class="selected"></span>');
        </script>

    <!--/ End left navigation - menu -->

    <!-- Start left navigation - footer -->
    <div class="sidebar-footer">
        <a id="setting" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Setting"><i class="fa fa-cog"></i></a>
        <a id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
        <a id="lock-screen" data-url="lock-screen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Lock Screen"><i class="fa fa-lock"></i></a>
        <a id="logout" data-url="signin" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Logout"><i class="fa fa-power-off"></i></a>
    </div><!-- /.sidebar-footer -->
    <!--/ End left navigation - footer -->

</aside><!-- /#sidebar-left -->
<!--/ END SIDEBAR LEFT -->
