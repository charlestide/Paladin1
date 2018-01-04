<template>
    <button class="btn rounded" :type="type" :class="['btn-'+size,'input-group-'+size,{'btn-theme':theme}]" data-container="body" @click="handlerClick" >
        <i v-if="icon" :class="iconClass"></i> {{title}}
    </button>
</template>

<script>
    import {IconMixin} from "../common/IconMixin";

    let _ = require('underscore');

    export default {
        name: "pvc-button",
        mixins: [IconMixin],
        data() {
            return {
                pvcName: 'button',
                pvcType: 'button'
            }
        },
        props: {
            action: [Function,String],
            mixins: [IconMixin],
            size: {
                type: String,
                default: "sm",
                validator: function (value) {
                    return value in {lg:'',sm:'',xs:''};
                }
            },
            target: {
                type: String,
                default: '_self',
                validator: function (value) {
                    return value in {_self:'',_blank:''};
                }
            },
            title: String,
            type: {
                type: String,
                default: 'button',
                validator(value) {
                    return value in {button:'',submit:''}
                }
            },
            method: {
                type: String,
                default: 'get'
            },
            confirm: {
                type: [Boolean,String],
                default: false
            },
            theme: {
                type: Boolean,
                default: true
            }
        },
        mounted: function () {
            if (this.$parent.addButtonData) {
                let button = {
                    target: this.target,
                    action: this.action,
                    title: this.title,
                    size: this.size,
                    icon: this.icon
                };

                this.$parent.addButtonData(button);
            }
        },
        methods: {
            doClick: function () {
                if (this.type !== 'button') {
                    return true;
                }

                if (_.isFunction(this.action)) {
                    this.action();
                } else {
                    if (this.method.toLowerCase() !== 'get') {
                        $.ajax({
                            type: this.method,
                            url: this.action,
                            dataType: 'json',
                            success(data) {
                                if (data.status) {
                                    window.location.href = data;
                                } else {
                                    alert(data.message);
                                }
                            },
                            error(httpRequest,textStatus) {
                                alert('Error: ' + textStatus);
                            }
                        })
                    } else {
                        window.location.href = this.action;
                    }
                }
            },
            handlerClick() {
                if (this.confirm) {
                    this.showConfirm(this.confirm);
                } else {
                    this.doClick();
                }
            },

            showConfirm(message) {
                let self = this,
                    config = {
                        content: '一般出现此对话框表示此操作不可还原，请谨慎选择',
                        title: message ? message : '您确定要进行此操作吗？',
                        confirm() {
                            self.doClick();
                        },
                        buttons: {
                            ok: {
                                text: '确定',
                                btnClass: 'btn-theme'
                            },
                            close: {
                                text: '关闭',
                            }
                        }
                    };

                $.confirm(config);
            }
        }
    }
</script>

<style scoped>


</style>