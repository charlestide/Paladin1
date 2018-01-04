<template>
    <div class="echarts flot-overlay">
        <IEcharts :option="_options" :loading="loading" :resizable="true" :style="sizeStyle" ></IEcharts>
    </div>
</template>

<script>
    import IEcharts from 'vue-echarts-v3/src/lite';
    import 'echarts/lib/chart/line';
    import 'echarts/lib/component/title';
    let _ = require('underscore');

    export default {
        name: "pvc-echart-line",
        components: {
            IEcharts
        },
        props: {
            options: {
                type: [Object,String],
                default: ''
            },
            title: [String,Object],
            width: {
                type:[Number,String],
                default: 300
            },
            height: {
                type:[Number,String],
                default: 300
            },
            xAxis: [Array,Object,String],
            yAxis: [Array,Object,String],
            data: [Array,Object],
            series: [Array],
            tooltip: [Object],
            loading: {
                type: Boolean,
                default: false
            },
            textColor: String
        },
        // data: () => ({
        //     line: {
        //         title: {
        //             text: 'ECharts Hello World'
        //         },
        //         tooltip: {},
        //         xAxis: {
        //             data: ['Shirt', 'Sweater', 'Chiffon Shirt', 'Pants', 'High Heels', 'Socks']
        //         },
        //         yAxis: {},
        //         series: [{
        //             name: 'Sales',
        //             type: 'bar',
        //             data: [5, 20, 36, 10, 10, 20]
        //         }]
        //     }
        // }),
        computed: {
            _xAxis() {
                switch (typeof(this.xAxis)) {
                    case 'string': return {name: this.xAxis};
                    case 'object': return this.xAxis;
                    case 'array': return {data: this.xAxis}
                    default: return {};
                }
            },
            _yAxis() {
                switch (typeof(this.yAxis)) {
                    case 'string': return {name: this.yAxis};
                    case 'object': return !_.isEmpty(this.yAxis) ? this.yAxis : {};
                    case 'array': return {data: this.yAxis};
                    default: return {};
                }
            },
            _title() {
                switch (typeof(this.title)) {
                    case 'string': return {text: this.title};
                    case 'object': return this.title;
                }
            },
            _options() {
                let opt = {
                    series: this.series,
                    xAxis: this._xAxis,
                    yAxis: this._yAxis
                };

                if (!_.isEmpty(this._title)) {
                    opt.title = this._title;
                }

                if (!_.isEmpty(this.textColor)) {
                    opt.textStyle = this.textColor;
                }

                if (!_.isEmpty(this.tooltip)) {
                    opt.tooltip = this.tooltip;
                }

                return opt;
            },
            sizeStyle() {
                let s = 'width: ' + this.width
                    + (_.isNumber(this.width) ? 'px' : '')
                    + ';height: '+ this.height
                    + (_.isNumber(this.height) ? 'px' : '');
                return s;
            }
        },
        methods: {
            parseOption(options) {
                let self = this;

                return _.mapObject(options, function (value, key) {
                    if (_.isString(value) && value.search('::') !== -1) {
                        return self.parseShortSet(value);
                    } else if (_.isObject(value)) {
                        return self.parseOption(value);
                    } else if (_.isEmpty(value)) {
                        return key;
                    } else {
                        return value;
                    }
                });
            },
            /**
             * 将
             *    nameA::nameB::value
             * 转为
             *    {
             *      nameA: {
             *          nameB: value
             *      }
             *    }
             * @param value
             * @returns {*}
             */
            parseShortSet(value) {
                if (_.isString(value)) {
                    let parts = value.split('::'),
                        object = {};

                    if (_.isArray(parts) && parts.length > 1) {
                        object[parts[0]] = this.parseShortSet(value.replace(parts[0]+'::',''));
                        return object;
                    }
                }
                return value;
            }
        }
    }
</script>

<style scoped>

</style>