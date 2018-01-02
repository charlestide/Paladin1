@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <!-- Start page header -->
    <div class="header-content">
        <h2><i class="fa fa-home"></i>Dashboard <span>dashboard & statistics</span></h2>
        <div class="breadcrumb-wrapper hidden-xs">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div><!-- /.header-content -->
    <!--/ End page header -->

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-facebook rounded">
                    <span class="mini-stat-icon">
                        <img src="/paladin/img/lang/php.png" width="50" height="50"/>
                    </span>
                    <div class="mini-stat-info">
                        <span>{{phpversion()}}</span>
                        PHP Language
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix rounded bg-twitter " style="background: #37AD51">
                    <span class="mini-stat-icon" style="color:white">
                        <img src="/paladin/img/lang/vue.png" width="48" height="48" />
                    </span>

                    <div class="mini-stat-info">
                        <span id="vue"></span>
                        Vue.js Framework
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-googleplus rounded">
                    <span class="mini-stat-icon">
                        <img src="/paladin/img/lang/laravel.png"  width="48" height="48">
                    </span>
                    <div class="mini-stat-info">
                        <span>{{app()->version()}}</span>
                        Laravel Framework
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-soundcloud rounded">
                    <span class="mini-stat-icon">
                        <img src="/paladin/img/lang/mysql.png"  width="48" height="48">
                    </span>
                    <div class="mini-stat-info">
                        <span>{{$mysqlVersion}}</span>
                        Mysql Database
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-9">

                <!-- Start widget visitor chart -->
                <div id="tour-13" class="panel stat-stack widget-visitor rounded shadow">
                    <div class="panel-body no-padding br-3">
                        <div class="row row-merge">
                            <div class="col-sm-8">
                                <div class="panel panel-theme stat-left no-margin no-box-shadow">
                                    <div class="panel-heading no-border">
                                        <div class="pull-left">
                                            <h3 class="panel-title">Daily Visitor</h3>
                                        </div><!-- /.pull-left -->
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-theme dropdown-toggle no-border" data-toggle="dropdown">
                                                    Duration <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right no-border">
                                                    <li class="dropdown-header">Select duration :</li>
                                                    <li><a href="#">Year</a></li>
                                                    <li><a href="#">Month</a></li>
                                                    <li><a href="#">Week</a></li>
                                                    <li><a href="#">Day</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.pull-right -->
                                        <div class="clearfix"></div>
                                    </div><!-- /.panel-heading -->
                                    <div class="panel-body bg-theme">

                                        <div id="visitor-chart" class="resize-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" width="976" height="500" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 488px; height: 250px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 21px; text-align: center;">Jan</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 95px; text-align: center;">Feb</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 168px; text-align: center;">Mar</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 244px; text-align: center;">Apr</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 316px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 392px; text-align: center;">Jun</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 70px; top: 229px; left: 468px; text-align: center;">Jul</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 214px; left: 4px; text-align: right;">200</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 187px; left: 4px; text-align: right;">300</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 160px; left: 4px; text-align: right;">400</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 134px; left: 4px; text-align: right;">500</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 107px; left: 4px; text-align: right;">600</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 80px; left: 5px; text-align: right;">700</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 54px; left: 4px; text-align: right;">800</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 27px; left: 4px; text-align: right;">900</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 0px; text-align: right;">1000</div></div></div><canvas class="flot-overlay" width="976" height="500" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 488px; height: 250px;"></canvas><div class="legend"><div style="position: absolute; width: 86px; height: 42px; top: 16px; right: 17px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:16px;right:17px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgba(0, 177, 225, 0.35);overflow:hidden"></div></div></td><td class="legendLabel">New Visitor</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgba(233, 87, 63, 0.36);overflow:hidden"></div></div></td><td class="legendLabel">Old Visitor</td></tr></tbody></table></div></div>

                                    </div><!-- /.panel-body -->
                                    <div class="panel-footer no-border-top">
                                        <div class="row text-center">
                                            <div class="col-xs-4 col-xs-override border-right dotted">
                                                <p class="text-danger text-strong mb-0">- 5%</p>
                                                <p class="h3 text-strong mb-0 mt-10 counter-visit" data-counter="7341">7,341</p>
                                                <p class="text-muted">Visits Today</p>
                                            </div>
                                            <div class="col-xs-4 col-xs-override border-right dotted">
                                                <p class="text-success text-strong mb-0">+ 32%</p>
                                                <p class="h3 text-strong mb-0 mt-10 counter-unique" data-counter="23762">23,762</p>
                                                <p class="text-muted">Unique Visitors</p>
                                            </div>
                                            <div class="col-xs-4 col-xs-override">
                                                <p class="text-success text-strong mb-0">+ 76%</p>
                                                <p class="h3 text-strong mb-0 mt-10 counter-page" data-counter="70112">70,112</p>
                                                <p class="text-muted">Page Views</p>
                                            </div>
                                        </div>
                                    </div><!-- /.panel-footer -->
                                </div><!-- /.panel -->
                            </div><!-- /.col-sm-8 -->
                            <div class="col-sm-4">
                                <div class="panel stat-right no-margin no-box-shadow">
                                    <div class="panel-body">
                                        <h4 class="no-margin">服务器状态</h4>
                                        <p class="text-muted">{{$software['os']}} {{$hardware['model']}}</p>

                                        <p><span>运行时间</span><span class="pull-right">{{$uptime['uptime']}}</span></p>
                                        <p><span>上次启动</span><span class="pull-right">{{$uptime['booted_at']}}</span></p>
                                        <p><span>CPU</span><span class="pull-right">{{$hardware['cpu']}} * {{$hardware['cpu_count']}}</span></p>
                                        <p><span>Web Server</span><span class="pull-right">{{$software['webserver']}} on {{$software['arc']}}</span></p>

                                        <span>内存剩余率</span><span class="pull-right">({{floor($memUsage['free'] / $memUsage['total']*100)}}%)</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$memUsage['free']}}" aria-valuemin="0" aria-valuemax="{{$memUsage['total']}}" style="width: {{floor($memUsage['free'] / $memUsage['total']*100)}}%"></div>
                                        </div><!-- /.progress -->

                                        <span>硬盘剩余率</span><span class="pull-right">({{floor($diskUsage['free'] / $diskUsage['total']*100)}}%)</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$diskUsage['free']}}" aria-valuemin="0" aria-valuemax="{{$diskUsage['total']}}" style="width:{{floor($diskUsage['free'] / $diskUsage['total']*100)}} %"></div>
                                        </div><!-- /.progress -->

                                        <span>Swap剩余率</span><span class="pull-right">(({{floor($swapUsage['free'] / $swapUsage['total']*100)}}%))</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{$swapUsage['free']}}" aria-valuemin="0" aria-valuemax="{{$swapUsage['total']}}" style="width: {{floor($swapUsage['free'] / $swapUsage['total']*100)}}%"></div>
                                        </div><!-- /.progress -->
                                    </div><!-- /.panel-body -->
                                    <div class="panel-footer">
                                        <div id="realtime-status-chart" class="resize-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" width="430" height="200" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 215px; height: 100px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 78px; left: 27px; text-align: center;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 78px; left: 60px; text-align: center;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 78px; left: 95px; text-align: center;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 78px; left: 131px; text-align: center;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 36px; top: 78px; left: 167px; text-align: center;">40</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 58px; left: 13px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 29px; left: 6px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">100</div></div></div><canvas class="flot-overlay" width="430" height="200" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 215px; height: 100px;"></canvas></div>
                                    </div>
                                </div><!-- /.panel -->
                            </div><!-- /.col-sm-4 -->
                        </div><!-- /.row -->
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
                <!--/ End widget visitor chart -->

            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">

                        <!-- Start weather widget -->
                        <div id="weather-widget" class="widget-wrapper bg-theme rounded">
                            <div class="weather-current-city">
                                <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <span class="current-city">
                                            @{{city}} @{{location}}
                                        </span>
                                        <span class="current-temp" >
                                            @{{now.tmp}} &deg;C
                                        </span>
                                    </div><!-- /.col-md-7 -->
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                            <span class="current-day-icon" >
                                              <canvas id="today_icon" width="60" height="60" icon="skyicon"></canvas>
                                            </span>
                                    </div><!-- /.col-md-5 -->
                                </div><!-- /.row -->
                                <span class="current-day"> {{date('l')}}, {{date('j')}} {{date('F')}} {{date('Y')}}</span>
                            </div><!-- /.weather-current-city -->
                            <div class="row">
                                <ul class="days">
                                    <li v-show="forecast.length" v-for="(fore,index) in forecast" class="col-md-4 col-sm-4 col-xs-4">
                                        <strong>@{{fore.date}}</strong>
                                        <canvas :id="'skyicon_'+index" :icon="fore.icon" role="skyicon" width="45" height="45"></canvas>
                                        <span>@{{fore.tmp_min}}-@{{fore.tmp_max}}°</span>
                                    </li>
                                </ul><!-- /.days -->
                            </div><!-- /.row -->
                        </div><!-- /.widget-wrapper -->
                        <!--/ End weather widget -->

                        <div class="divider"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">

                        <!-- Start blog post widget -->
                        <div class="blog-item blog-quote rounded shadow">
                            <div class="quote quote-lilac">
                                <a href="page-blog-single.html">
                                    Stay Hungry, Stay Foolish
                                    <small class="quote-author">- Steve Jobs -</small>
                                </a>
                            </div>
                            <div class="blog-details">
                                <ul class="blog-meta">
                                    <li>By: <a href="">Djava UI</a></li>
                                    <li>Jun 08, 2014</li>
                                    <li><a href="">2 Comments</a></li>
                                </ul>
                            </div><!-- blog-details -->
                        </div><!-- blog-item -->
                        <!--/ End blog post widget -->

                    </div>
                </div>

            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-9">
                <pvc-panel title="路由" :closeable="true">
                    <pvc-datatable source="/dashboard/routes">
                        <pvc-data-column data="method" title="方法" default="无数据"></pvc-data-column>
                        <pvc-data-column data="uri" title="描述" default="无数据"></pvc-data-column>
                        <pvc-data-column data="name" title="名称" default="无数据"></pvc-data-column>
                        <pvc-data-column data="action" title="动作" default="无数据"></pvc-data-column>
                        <pvc-data-column data="middleware" title="中间件" default="无数据"></pvc-data-column>
                    </pvc-datatable>
                </pvc-panel>
            </div>
            <div class="col-md-3">

                <!-- Start mini stats social widget -->
                <div id="tour-17" class="row">
                    <div class="col-md-12  col-xs-4 col-xs-override">

                        <div class="panel rounded shadow">
                            <div class="panel-heading text-center bg-youtube">
                                <p class="inner-all no-margin">
                                    <i class="fa fa-youtube fa-5x"></i>
                                </p>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body text-center">
                                <p class="h4 no-margin inner-all text-strong">
                                    <span class="block counter">342</span>
                                    <span class="block">Videos</span>
                                </p>
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->

                    </div>
                    <div class="col-md-12 col-sm-4 col-xs-4 col-xs-override">

                        <div class="panel rounded shadow">
                            <div class="panel-heading text-center bg-dribbble">
                                <p class="inner-all no-margin">
                                    <i class="fa fa-dribbble fa-5x"></i>
                                </p>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body text-center">
                                <p class="h4 no-margin inner-all text-strong">
                                    <span class="block counter">1,580</span>
                                    <span class="block">Designs</span>
                                </p>
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->

                    </div>
                    <div class="col-md-12 col-sm-4 col-xs-4 col-xs-override">

                        <div class="panel rounded shadow">
                            <div class="panel-heading text-center bg-soundcloud">
                                <p class="inner-all no-margin">
                                    <i class="fa fa-soundcloud fa-5x"></i>
                                </p>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body text-center">
                                <p class="h4 no-margin inner-all text-strong">
                                    <span class="block counter">21,426</span>
                                    <span class="block">Musics</span>
                                </p>
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->

                    </div>
                </div>

                <!--/ End mini stats social widget -->

            </div>
        </div>
    </div><!-- /.body-content -->
    <!--/ End body content -->


@push('scripts')
    <script src="/paladin/js/data.js"></script>
    <script src="https://cdn.bootcss.com/skycons/1396634940/skycons.min.js"></script>
    <script type="text/javascript">
        if (typeof(window.content) === 'undefined') {
            window.content = new Vue({
                el: '#page-inner',
                data: {
                    key: '84db9b36de5c40058b075bf5c621c5cc',
                    location: '',
                    city: '上海',
                    isp: '',
                    ip: '{{!starts_with($_SERVER["REMOTE_ADDR"],'127') ? : ''}}',
                    country: '',
                    skyicon: '',
                    now: {},
                    forecast: [],
                },
                mounted() {
                    this.getWeather();
                },
                methods: {
                    showPhpModules() {
                        let $phpinfo = $('#phpinfo'),
                            $tables = $('table',$phpinfo);


                    },
                    getLocalLocation() {
                        if (navigator.geolocation){
                            navigator.geolocation.getCurrentPosition(function (position) {
                                return {
                                    lati: position.coords.latitude,
                                    long: position.cookie.longitude
                                }
                            },(errors) => {
                                console.log(errors);
                            },{
                                enableHighAcuracy: false
                            });
                        }else{
                            console.log('not supported');
                        }
                    },
                    transIcon(code) {
                        switch (code.substring(0, 1)) {
                            case '1': return 'clear-day';
                            case '2': return 'wind';
                            case '3': return 'rain';
                            case '4': return 'snow';
                            case '5': return 'fog';
                        }
                    },
                    getWeather() {
                        let self = this,
                            location = this.location ? this.location : this.ip ? this.ip : this.city ? this.city : 'shanghai',
                            skycons = new Skycons({"color": "white"},{"resizeClear": true});

                        $.getJSON('https://free-api.heweather.com/s6/weather/now?location='+location+'&key='+this.key,function (data) {
                            if (data.HeWeather6 && data.HeWeather6[0].status === 'ok') {
                                data = data.HeWeather6[0];

                                self.location = data.basic.location;
                                self.city = data.basic.parent_city;
                                self.region = data.basic.admin_area;
                                self.isp = data.isp;
                                self.country = data.basic.cnty;
                                self.now = data.now;
                                self.skyicon = self.transIcon(data.now.cond_code);
                                skycons.set('today_icon',self.skyicon);
                                skycons.play();
                            }
                        });

                        $.getJSON('https://free-api.heweather.com/s6/weather/forecast?location='+location+'&key='+this.key,function (data) {
                            if (data.HeWeather6 && data.HeWeather6[0].status === 'ok') {
                                data = data.HeWeather6[0];

                                data.daily_forecast.forEach(function (forecast) {
                                    if (typeof(forecast) === 'object') {
                                        forecast.icon = self.transIcon(forecast.cond_code_d);
                                        self.forecast.push(forecast);
                                    }
                                });

                                $(function () {
                                    self.forecast.forEach(function (fore,index) {
                                        let id = 'skyicon_'+index;
                                        skycons.set(id,$('#'+id).attr('icon'));
                                    });
                                    skycons.play();
                                });
                            }
                        });
                    }
                }
            });
            $('#vue').text(Vue.version);
        }
    </script>
@endpush

@stop
<!--/ END PAGE CONTENT -->
