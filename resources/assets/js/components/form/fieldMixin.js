

export let fieldMixin = {
    props: {
        name: String,
        value: String,
        placeholder: String,
        label:String,
        enabled: {
            type: Boolean,
            default: true
        },
        disabled: String,
        desc: String,
    },
    computed: {
        fieldEnabled() {
            if (this.disabled) {
                return false;
            } else {
                return this.enabled;
            }
        },
    }
};