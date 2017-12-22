/**
 * Author: Charles.Tide<charlestide@vip.163.com>
 * Date: 2017/11/20.
 */



function RemoteLoader() {
}

/**
 * schema配置
 * @type {object}
 */
RemoteLoader.schemaConfig = null;

/**
 * 被加入require的listener
 * @type {Array}
 */
RemoteLoader.schemas = [];


/**
 * 加载配置
 * @param schemaConfigPath
 */
RemoteLoader.schema = function (schemaConfigPath) {
    if(window.XMLHttpRequest){
        ajax = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        ajax = new window.ActiveXObject();
    }else{
        console.log("your browser not support AJAX");
    }

    if(ajax !== null){
        ajax.open("GET",schemaConfigPath,true);
        ajax.send(null);
        ajax.onreadystatechange=function(){
            if(ajax.readyState === 4 && ajax.status === 200){
                RemoteLoader.schemaConfig = JSON.parse(ajax.responseText);

                RemoteLoader.schemas.forEach(function (schema) {
                    RemoteLoader.requireOne(schema);
                });
            }
        };
    }
};

/**
 * 将schema加入到待加载列表
 * @param schema
 */
RemoteLoader.require = function (schema) {
    RemoteLoader.schemas.push(schema);
};

/**
 * 加载模块
 * @param schema
 */
RemoteLoader.requireOne = function(schema) {
    if (RemoteLoader.schemaConfig.hasOwnProperty(schema)) {
        var sc = this.schemaConfig[schema];

        if (sc.hasOwnProperty('css')) {
            sc.css.forEach(function (file) {
                self.loadCss(file);
            })
        }

        if (sc.hasOwnProperty('js')) {
            RemoteLoader.schemaConfig[schema].js.forEach(function (file) {
                self.loadJs(file);
            })
        }
    }
};

/**
 * 加载JS
 * @param filePath
 */
RemoteLoader.loadJs = function (filePath) {
    var scriptTag = document.createElement('script');
    scriptTag.src = filePath;
    scriptTag.type = "text/javascript";
    document.getElementsByTagName('head')[0].appendChild(scriptTag);
};

/**
 * 加载CSS
 * @param filePath
 */
RemoteLoader.loadCss = function (filePath) {
    var linkTag = document.createElement('link');
    linkTag.href = filePath;
    linkTag.rel = 'stylesheet';
    linkTag.type = 'text/css';
    document.getElementsByTagName('head')[0].appendChild(linkTag);
};

/**
 * 为onload事件增加监听
 * @param listener
 */
RemoteLoader.load = function (listener) {
    var oldonload = window.onload;
    if ((typeof window.onload) !== 'function') {
        window.onload = listener;
    } else {
        window.onload = function () {
            oldonload();
            listener();
        }
    }
};

export default {
    install: function (Vue) {
        Vue.prototype.$RemoteLoader = RemoteLoader;
    }
}

