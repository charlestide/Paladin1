
import Launcher from "paladin-vue";
import map from "../../../preloader.mapping"

let launcher = new Launcher(window);

launcher.setComponentMap(map);

window.app = launcher.boot().$mount('#app');
window.launcher = launcher;