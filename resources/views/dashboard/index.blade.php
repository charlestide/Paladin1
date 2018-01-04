@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="Dashboard" summary="首页或称为仪表盘">
        <pvc-bread-crumb-item title="Dashboard" url="/dashboard"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

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
                                            <h3 class="panel-title">空闲内存 (M)</h3>
                                        </div><!-- /.pull-left -->
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <pvc-button :title="cpuButtonText" :theme="false" class="btn-warning" style="font-weight: bold;" :action="cpuUsageSwitch"></pvc-button>
                                            </div>
                                        </div><!-- /.pull-right -->
                                        <div class="clearfix"></div>
                                    </div><!-- /.panel-heading -->
                                    <div class="panel-body bg-theme">
                                        <pvc-echart-line class="echart" :loading="true" text-color="#fff" :series="series" :tooltip="tooltip" :x-axis="xAxis" :y-axis="yAxis"></pvc-echart-line>
                                    </div><!-- /.panel-body -->
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

                                        <span>内存剩余率</span><span class="pull-right">({{ceil($memUsage['free'] / $memUsage['total']*100)}}%)</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$memUsage['free']}}" aria-valuemin="0" aria-valuemax="{{$memUsage['total']}}" style="width: {{ceil($memUsage['free'] / $memUsage['total']*100)}}%"></div>
                                        </div><!-- /.progress -->

                                        <span>硬盘剩余率</span><span class="pull-right">({{ceil($diskUsage['free'] / $diskUsage['total']*100)}}%)</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$diskUsage['free']}}" aria-valuemin="0" aria-valuemax="{{$diskUsage['total']}}" style="width:{{ceil($diskUsage['free'] / $diskUsage['total']*100)}} %"></div>
                                        </div><!-- /.progress -->

                                        <span>Swap剩余率</span><span class="pull-right">({{ceil($swapUsage['free'] / $swapUsage['total']*100)}}%)</span>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{$swapUsage['free']}}" aria-valuemin="0" aria-valuemax="{{$swapUsage['total']}}" style="width: {{ceil($swapUsage['free'] / $swapUsage['total']*100)}}%"></div>
                                        </div><!-- /.progress -->
                                    </div><!-- /.panel-body -->
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
                    <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                        <div class="blog-item blog-quote rounded shadow">
                            <div class="quote quote-lilac">
                                <a href="http://www.diffearth.com">
                                    Different Earth
                                    <small class="quote-author">- Charles.Tide -</small>
                                </a>
                            </div>
                        </div><!-- blog-item -->
                    </div>

                </div>

            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-12">
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

        </div>
    </div><!-- /.body-content -->
    <!--/ End body content -->


@push('scripts')
    <script src="/paladin/js/data.js"></script>
    <script src="/paladin/js/chart.js"></script>
    <script src="https://cdn.bootcss.com/skycons/1396634940/skycons.min.js"></script>
    <script type="text/javascript">
        if (typeof(window.content) === 'undefined') {
            window.content = new Vue({
                el: '#page-inner',
                data: {
                    //天气预报相关数据
                    key: '84db9b36de5c40058b075bf5c621c5cc',
                    location: '',
                    city: '上海',
                    skyicon: '',
                    now: {},
                    forecast: [],

                    //是否开始更新CPU使用率
                    enableUpdateCpuUsage: false,
                    //CPU使用率图表配置
                    series: [{
                        type: 'line',
                        data: [],
                        smooth: true,
                        itemStyle: {
                            normal: {
                                color: '#fff'
                            }
                        },
                        areaStyle: {
                            normal: {
                                color: '#FFA500'
                            }
                        }
                    }],
                    xAxis: {
                        type: 'time',
                        axisLine: {
                            lineStyle: {
                                color: '#fff'
                            }
                        },
                        axisTick: {
                            lineStyle: {
                                color: '#fff'
                            }
                        },
                        axisLabel: {
                            color: '#fff'
                        }
                    },
                    yAxis: {
                        type: 'value',
                        data: [0,20,40,60,80,100],
                        axisLine: {
                            lineStyle: {
                                color: '#fff'
                            }
                        },
                        axisTick: {
                            lineStyle: {
                                color: '#fff'
                            }
                        },
                        axisLabel: {
                                color: '#fff'
                        }
                    },
                    toolbox: {
                        feature: {
                            dataZoom: {
                                yAxisIndex: 'none'
                            },
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        position: function (pt) {
                            return [pt[0], '10%'];
                        }
                    },
                },
                computed: {
                    cpuButtonText() {
                        return this.enableUpdateCpuUsage ? '点击停止更新' : '更新10秒钟';
                    }
                },
                mounted() {
                    this.getWeather();
                    this.updateCpuUsage();
                    this.enableUpdateCpuUsage = true;
                },
                watch: {
                    enableUpdateCpuUsage(newValue) {
                        let inter = null, timeout = null,self = this;
                        if (newValue) {
                            inter = setInterval(this.updateCpuUsage,1000);
                            timeout = setTimeout(function () {
                                clearInterval(inter);
                                self.enableUpdateCpuUsage = false;
                            },5000);
                        } else {
                            clearInterval(inter);
                        }
                    }
                },
                methods: {
                    //映射天气图标名称
                    transIcon(code) {
                        switch (code.substring(0, 1)) {
                            case '1': return 'clear-day';
                            case '2': return 'wind';
                            case '3': return 'rain';
                            case '4': return 'snow';
                            case '5': return 'fog';
                        }
                    },
                    //获取天气
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
                    },
                    //每秒更新空闲内存的方法
                    updateCpuUsage() {
                        const self = this;
                        $.getJSON('/dashboard/usage',function (data) {

                            let freeMem = data.freeMem;
                            freeMem = Math.ceil(freeMem / 1024 / 1024);

                            self.series[0].data.push([Date.parse(new Date()),freeMem]);
                        })
                    },

                    //启用或关闭CPU使用率图表更新
                    cpuUsageSwitch() {
                        this.enableUpdateCpuUsage = !this.enableUpdateCpuUsage;
                    }
                },
            });
            //显示vue的版本号
            $('#vue').text(Vue.version);
        }
    </script>
@endpush

@stop
<!--/ END PAGE CONTENT -->
