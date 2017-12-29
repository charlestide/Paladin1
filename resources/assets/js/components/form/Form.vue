<template>
    <form class="form-horizontal form-bordered validate" role="form" >
        <input v-if="token" type="hidden" name="_token" :value="token" />
        <slot name="hidden" />
        <div class="form-body">
            <slot/>
        </div>
        <div class="form-footer">
            <div class="col-sm-offset-3">
                <slot name="footer" />
            </div>
        </div>
    </form>
</template>

<script>
    import {ItemListMixin} from "../common/ItemListMixin";
    import RemoteLoader from "../../remoteLoader";

    export default {
        name: "pvc-form",
        mixins: [ItemListMixin],
        props: {
            token: String,
            validation: {
                type:Boolean,
                default: false
            }
        },
        mounted: function () {

            let self = this;

            RemoteLoader.loadJs([
                'https://cdn.bootcss.com/jquery-validate/1.17.0/jquery.validate.min.js',
                'https://cdn.bootcss.com/jquery-validate/1.17.0/localization/messages_zh.min.js'
            ],function () {
                $(function () {
                    if (self.validation) {
                        $(self.$el).validate({
                            highlight:function(element) {
                                $(element).parents('.form-group').addClass('has-error has-feedback');
                            },
                            unhighlight: function(element) {
                                $(element).parents('.form-group').removeClass('has-error');
                            },
                            success: function (label) {
                                $(label).parents('.form-group').addClass('has-success').removeClass('has-error');
                            },
                            submitHandler: function (form) {
                                form.submit();
                            }
                        });
                    }
                });
            });

        }
    }
</script>

<style scoped>

</style>