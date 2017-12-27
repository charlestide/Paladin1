
import PvcFieldLayout from "./FieldLayout";


export let layoutMixin = {
        components: {
            PvcFieldLayout,
        },
        data() {
            return {
                layoutProps: {
                    layout: this.layout,
                    required: this.required,
                    label: this.label
                }
            }
        },
        props: {
            required: {
                type: Boolean,
                default: false
            },
            label: String,
            layout: {
                type: String,
                default: 'hor',
                validate: function (value) {
                    return value in {hor:'',ver:'',none:''}
                }
            }
        }
    },
    valueMixin = {
        data() {
            return {
                valueProps: {
                    name: this.name,
                    value: this.value,
                    placeholder: this.placeholder
                }
            }
        },
        props: {
            name: String,
            value: String,
            placeholder: String,
        }
    },
    validateMixin = {
        props: {
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
        data() {
            return {
                validationProps: {
                    remote: this.remote,
                    email: this.email,
                    url: this.url,
                    date: this.date,
                    dateISO: this.dateISO,
                    number: this.number,
                    digits: this.digits,
                    equalTo: this.equalTo,
                    accept: this.accept,
                    creditcard: this.creditcard,
                    extension: this.extension,
                    require_from_group: this.require_from_group
                }
            }
        }
    },
    styleMixin = {
        props: {
            icon: String,
            round: {
                type: Boolean,
                default: true
            },
        }
    }
;

