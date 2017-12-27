

export let IconMixin = {
    props: {
        icon: String
    },
    computed: {
        iconClass: function () {
            let iconClass = '';
            if (this.icon) {
                let iconName = this.icon.split('-', 2);
                if (iconName.length > 1) {
                    switch (iconName[0]) {
                        case 'g-':
                        case 'gl-':
                        case 'glyphicon':
                            iconClass = 'glyphicon glyphicon-' + iconName[1];
                            break;

                        case 'fa':
                        default:
                            iconClass = 'fa fa-' + this.icon;
                    }
                } else {
                    iconClass = 'fa fa-' + this.icon;
                }
            } else {
                iconClass = 'fa fa-circle-o';
            }

            return iconClass;
        }
    }

};