<template>
    <div v-show="type !== 'hidden'" class="form-group">
        <label v-if="label" class="control-label" :class="{'col-sm-3': labelPosition === 'left'}">{{label}} <span v-if="required" class="asterisk">*</span></label>
        <div :class="['input-group-'+size,{'rounded': round},{'col-sm-7': labelPosition === 'left' && label}]">
            <input
                    :class="['input-'+size]"
                    class="form-control"
                    :placeholder="placeholder"
                    :name="name"
                    :type="type"
                    :value="value"

                    :required="required"
                    :remote="remote"
                    :email="email"
                    :url="url"
                    :date="date"
                    :dateISO="dateISO"
                    :number="number"
                    :digits="digits"
                    :equalTo="equalTo"
                    :accept="accept"
                    :creditcard="creditcard"
                    :extension="extension"
                    :require_from_group="require_from_group"
            >
            <span v-if="icon" class="input-group-addon"><i class="fa" :class="'fa-' + icon"></i></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pvc-text-field",
        props: {
            placeholder: String,
            name: String,
            icon: String,
            label: String,
            value: String,
            size: {
                type: String,
                default: "sm",
                validator: function (value) {
                    return value in {lg:'',sm:'',sx:''};
                }
            },
            round: {
                type: Boolean,
                default: true
            },
            type: {
                type: String,
                validator: function (value) {
                    return value in {hidden:'',password:'',text:'',email:''};
                },
                default:'text'
            },
            required: {
                type:Boolean,
                default: false
            },
            labelPosition: {
                type: String,
                validator: function (value) {
                    return value in {left:'',top:''};
                },
                default: 'left'
            },

            remote: String,
            email: Boolean,
            url: Boolean,
            date: Boolean,
            dateISO: Boolean,
            number: Boolean,
            digits: Boolean,
            equalTo: String,
            accept: String,
            creditcard: String,
            extension: String,
            require_from_group: String
        },
        computed: {
            show: function () {
                return this.type !== 'hidden';
            }
        }
    }
</script>

<style scoped>

</style>