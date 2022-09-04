var rapid = (function () {

    const configs = {
        callbacks: {},
        paths: {
            dir: "", libs: "", app: "", res: "", assets: "", layout: ""
        }, dataNames: {
            controllerName: "data-controller",
            controllerMain: "data-controller-main",
            contentPathDir: "data-path-dir",
            contentPathLibs: "data-path-libs",
            contentPathApp: "data-path-app",
            contentPathRes: "data-path-res",
            contentPathAssets: "data-path-res-assets",
            contentPathLayout: "data-path-res-layout",
            contentConfigPlugins: "data-config-plugins",
            contentConfigWxSdk: "data-config-wxSdk"
        }, plugins: [], controllers: [], mainController: null, isInit: false
    };

    /**
     * setGlobalConfigPathInit
     */
    function setGlobalConfigPathInit() {
        const dir = rapid.getJavaScriptContentConfig(configs.dataNames.contentPathDir).toString();

        rapid.setGlobalConfigPathDir(dir);

        const libs = rapid.getJavaScriptContentConfig(configs.dataNames.contentPathLibs).toString() || dir + 'libs/';

        rapid.setGlobalConfigPathLibs(libs);

        const app = rapid.getJavaScriptContentConfig(configs.dataNames.contentPathApp).toString() || dir + 'src/';

        rapid.setGlobalConfigPathApp(app);

        const res = rapid.getJavaScriptContentConfig(configs.dataNames.contentPathRes).toString() || dir + 'res/';

        rapid.setGlobalConfigPathRes(res);

        const assets = rapid.getJavaScriptContentConfig(configs.dataNames.contentPathAssets).toString() || dir + 'res/assets/';

        rapid.setGlobalConfigPathAssets(assets);

        const layout = rapid.getJavaScriptContentConfig(configs.dataNames.contentPathLayout).toString() || dir + 'res/layout/';

        rapid.setGlobalConfigPathLayout(layout);
    }

    /**
     * setGlobalConfigPluginsInit
     */
    function setGlobalConfigPluginsInit() {
        const plugins = rapid.getJavaScriptContentConfig(configs.dataNames.contentConfigPlugins);

        rapid.setGlobalConfigPlugins(plugins ? plugins.split("|") : []);
    }

    /**
     * setGlobalConfigControllerInit
     */
    function setGlobalConfigControllerInit() {
        const view = rapid.getHtmlContent();

        const controllers = Controller.getControllers(view);

        rapid.setGlobalConfigControllers(controllers);

        const mainController = Controller.getControllerMain(view, controllers);

        rapid.setGlobalConfigMainController(mainController);
    }

    /**
     * 解析uri信息
     * @param controllerUri
     * @returns {*}
     */
    function getUriInfo(controllerUri) {

        const data = {uri: "", fileName: "", parameter: ""};

        if (!controllerUri) return data;

        const uriInfo = controllerUri.split("/") || [];

        const fileName = uriInfo[uriInfo.length - 1] || "";

        data.uri = controllerUri.replace(fileName, "");

        const info = fileName.split("?") || [];

        data.fileName = info[0] || "";

        data.parameter = info[1] || "";

        return data;
    }

    /**
     * loadingPlugins
     * @param data
     * @param callback
     */
    function loadingPlugins(data, callback) {
        rapid.getPlugin().Loadings(data, callback);
    }


    /**
     * loadingControllers
     * @param data
     * @param callback
     */
    function loadingControllers(data, callback) {
        const list = [];

        const path = rapid.getGlobalConfigPathApp() + 'controller/';

        for (let i in data) {

            const uri = data[i];

            if (!uri) continue;

            const uriInfo = getUriInfo(uri);

            const src = path + uriInfo.uri + uriInfo.fileName + '.js' + (uriInfo.parameter ? '?' + uriInfo.parameter : '');

            list.push(src);
        }

        loadingPartial(0, list, callback);
    }

    /**
     * loadingPartial
     * @param i
     * @param data
     * @param callback
     * @returns {null}
     */
    function loadingPartial(i, data, callback) {
        const src = data[i];

        if (!src) return typeof callback === 'function' ? callback() : null;

        require([src], function () {
            i++;
            loadingPartial(i, data, callback);
        });
    }

    /**
     * controllerInit
     */
    function controllerInit() {
        let controllerName = rapid.getGlobalConfigMainController(), controller;

        if (controllerName) {
            if (typeof window[controllerName] !== 'object' && window[controllerName] !== null) {
                window[controllerName] = controller = eval("new " + controllerName);
            } else {
                controller = window[controllerName];
            }
            rapid.setGlobalConfigMainController(controller);
        }
        initCallback(controller);
    }

    /**
     * initCallback
     * @param controller
     */
    function initCallback(controller) {
        configs.isInit = true;

        initBindViewController();

        typeof window.rapidInit === 'function' ? window.rapidInit(controller) : null;

        typeof configs.callbacks.init === 'function' ? configs.callbacks.init(controller) : null;

        controller !== null && typeof controller === 'object' && typeof controller.onCreate === 'function' ? controller.onCreate() : null;
    }

    /**
     * initBindViewController
     */
    function initBindViewController() {
        new BindViewController();
    }

    /**
     * appStartTouch
     */
    function appStartTouch() {
        if ("ontouchstart" in document) document.addEventListener('touchstart', function () {
            return false;
        }, false);
    }

    /**
     * createdMsgViewed
     * @returns {View}
     */
    function createdMsgViewed() {
        const bodyView = rapid.getView(document.body);

        return rapid.getBuild().getOS() === 'Ios' ? bodyView.createdView("iframe", "data:text/plain")
                .css("display", "none") :
            bodyView.createdView("iframe").css("display", "none").attr("src", "data:text/plain");
    }

    /**
     * alert
     * @param title
     */
    function alerted(title) {

        title = title || '';

        const iframeView = createdMsgViewed();

        rapid.getBuild().getOS() === 'Ios' ? window.frames[0].window.alert(title) :
            iframeView.getIFrame().getWindow().alert(title);

        iframeView.remove();
    }

    /**
     * confirm
     * @param title
     */
    function confirmed(title) {

        title = title || '';

        const iframeView = createdMsgViewed();

        const result = rapid.getBuild().getOS() === 'Ios' ? window.frames[0].window.confirm(title) :
            iframeView.getIFrame().getWindow().confirm(title);

        iframeView.remove();

        return result;
    }

    /**
     * prompt
     * @param title
     * @param value
     * @return {*}
     */
    function prompted(title, value) {
        title = title || '';

        value = value || '';

        const iframeView = createdMsgViewed();

        const result = rapid.getBuild().getOS() === 'Ios' ? window.frames[0].window.prompt(title, value) :
            iframeView.getIFrame().getWindow().prompt(title, value);

        iframeView.remove();

        return result;
    }

    /**
     * rapid
     * @param javaScriptContent
     */
    function rapid(javaScriptContent) {
        appStartTouch();

        if (!(navigator.userAgent.indexOf("Firefox") > 0)) {
            window.alert = alerted;

            window.prompt = prompted;

            window.confirm = confirmed;
        }

        rapid.setJavaScriptContent(javaScriptContent) && setGlobalConfigPathInit() || setGlobalConfigPluginsInit() || setGlobalConfigControllerInit();

        loadingPlugins(rapid.getGlobalConfigPlugins(), function () {

            loadingControllers(rapid.getGlobalConfigControllers(), controllerInit);
        });
    }


    /**
     * __extends
     * @param d
     * @param b
     */
    rapid.__extends = function (d, b) {
        for (let p in b) if (b.hasOwnProperty(p)) d[p] = b[p];

        function __() {
            this.constructor = d;
        }

        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };

    /**
     * getHtmlContent
     * @returns {View}
     */
    rapid.getHtmlContent = function () {
        return View.findViewById("html");
    };

    /**
     * setJavaScriptContent
     * @param javaScriptContent
     * @returns {rapid}
     */
    rapid.setJavaScriptContent = function (javaScriptContent) {
        this.javaScriptContent = new View(javaScriptContent);

        return this;
    };

    /**
     * getJavaScriptContentConfig
     * @param name
     * @returns {string}
     */
    rapid.getJavaScriptContentConfig = function (name) {
        const value = Object(this.javaScriptContent.getAttr(name) || "");

        value.toObject = function () {
            try {
                return eval("(" + value + ")");
            } catch (e) {
                return {};
            }
        };
        return value;
    };


    /**
     * getGlobalConfig
     * @returns {{callbacks: {}, paths: {dir: string, libs: string, app: string, res: string, assets: string, layout: string}, dataNames: {controllerName: string, controllerMain: string, contentPathDir: string, contentPathLibs: string, contentPathApp: string, contentPathRes: string, contentPathAssets: string, contentPathLayout: string, contentConfigPlugins: string, contentConfigWxSdk: string}, plugins: Array, controllers: Array, mainController: null, isInit: boolean}}
     */
    rapid.getGlobalConfig = function () {
        return configs;
    };

    /**
     * setGlobalConfigPathDir
     * @param dir
     * @returns {rapid}
     */
    rapid.setGlobalConfigPathDir = function (dir) {
        configs.paths.dir = dir;

        return this;
    };


    /**
     * getGlobalConfigPathDir
     * @returns {string}
     */
    rapid.getGlobalConfigPathDir = function () {
        return configs.paths.dir;
    };

    /**
     * setGlobalConfigPathLibs
     * @param libs
     * @returns {rapid}
     */
    rapid.setGlobalConfigPathLibs = function (libs) {
        configs.paths.libs = libs;

        return this;
    };

    /**
     * getGlobalConfigPathLibs
     * @returns {string}
     */
    rapid.getGlobalConfigPathLibs = function () {
        return configs.paths.libs;
    };

    /**
     * 设置app路径
     * @param app
     * @returns {rapid}
     */
    rapid.setGlobalConfigPathApp = function (app) {
        configs.paths.app = app;

        return this;
    };

    /**
     * getGlobalConfigPathApp
     * @returns {string}
     */
    rapid.getGlobalConfigPathApp = function () {
        return configs.paths.app;
    };

    /**
     * setGlobalConfigPathAssets
     * @param assets
     * @returns {rapid}
     */
    rapid.setGlobalConfigPathAssets = function (assets) {
        configs.paths.assets = assets;
        return this;
    };

    /**
     * getGlobalConfigPathAssets
     * @returns {string}
     */
    rapid.getGlobalConfigPathAssets = function () {
        return configs.paths.assets;
    };

    /**
     * setGlobalConfigPathLayout
     * @param layout
     * @returns {rapid}
     */
    rapid.setGlobalConfigPathLayout = function (layout) {
        configs.paths.layout = layout;
        return this;
    };

    /**
     * getGlobalConfigPathLayout
     * @returns {string}
     */
    rapid.getGlobalConfigPathLayout = function () {
        return configs.paths.layout;
    };

    /**
     * setGlobalConfigPathRes
     * @param res
     * @returns {rapid}
     */
    rapid.setGlobalConfigPathRes = function (res) {
        configs.paths.res = res;
        return this;
    };

    /**
     * getGlobalConfigPathRes
     * @returns {string}
     */
    rapid.getGlobalConfigPathRes = function () {
        return configs.paths.res;
    };

    /**
     * setGlobalConfigPlugins
     * @param plugins
     * @returns {rapid}
     */
    rapid.setGlobalConfigPlugins = function (plugins) {
        configs.plugins = plugins;
        return this;
    };

    /**
     * addGlobalConfigPlugins
     * @param name
     * @returns {rapid}
     */
    rapid.addGlobalConfigPlugins = function (name) {
        configs.plugins.push(name);
        return this;
    };


    /**
     * getGlobalConfigPlugins
     * @returns {Array}
     */
    rapid.getGlobalConfigPlugins = function () {
        return configs.plugins;
    };

    /**
     * setGlobalConfigControllers
     * @param controllers
     * @returns {rapid}
     */
    rapid.setGlobalConfigControllers = function (controllers) {
        configs.controllers = controllers;

        return this;
    };


    /**
     * getGlobalConfigControllers
     * @returns {Array}
     */
    rapid.getGlobalConfigControllers = function () {
        return configs.controllers;
    };

    /**
     * setGlobalConfigMainController
     * @param controller
     * @returns {rapid}
     */
    rapid.setGlobalConfigMainController = function (controller) {
        configs.mainController = controller;

        return this;
    };


    /**
     * getGlobalConfigMainController
     * @returns {Array}
     */
    rapid.getGlobalConfigMainController = function () {
        return configs.mainController;
    };

    /**
     * getGlobalConfigIsInit
     * @returns {boolean}
     */
    rapid.getGlobalConfigIsInit = function () {
        return configs.isInit;
    };

    /**
     * init
     * @param callback
     * @returns {rapid}
     */
    rapid.init = function (callback) {
        configs.callbacks.init = callback;

        return this;
    };

    /**
     * getBuild
     * @returns {Build}
     */
    rapid.getBuild = function () {
        return new Build();
    };

    /**
     * getView
     * @param view
     * @returns {View}
     */
    rapid.getView = function (view) {
        return (view) ? View.findViewById(view) : View;
    };

    /**
     * getPlugin
     */
    rapid.getPlugin = function () {
        return Plugin;
    };

    var Build = (function () {

        /**
         * Build
         * @constructor
         */
        function Build() {

        }

        /**
         * getData
         * @param object
         * @param name
         * @returns {string}
         */
        Build.prototype.getData = function (object, name) {
            try {
                return object[name] ? object[name] : "";
            } catch (e) {
                return "";
            }
        };

        /**
         * each
         * @param object
         * @param callback
         */
        Build.prototype.each = function (object, callback) {
            if (typeof object === "object" && object !== null) {
                let i;
                if (typeof object.length === 'number') {
                    for (i = 0; i < object.length; i++) if (typeof callback === 'function') callback(i, object[i])
                } else {
                    for (i in object) if (typeof callback === 'function') callback(i, object[i]);
                }
            }
        };


        /**
         * getHttpResponse
         * @param url
         * @param data
         * @returns {*}
         */
        Build.prototype.getHttpResponse = function (url, data) {
            return new rapid.Http(url, data);
        };


        /**
         * toJson
         * @param string
         * @returns {{}}
         */
        Build.prototype.toJson = function (string) {
            try {
                return JSON.parse(string || '');
            } catch (e) {
                return {};
            }
        };

        /**
         * toUrlQuery
         * @param data
         * @param isEmpty
         * @returns {string}
         */
        Build.prototype.toUrlQuery = function (data, isEmpty) {
            var query = '';
            this.each(data, function (i, e) {
                e = e || "";
                if (isEmpty === true) {
                    if (e) query += i + '=' + e + '&';
                } else {
                    query += i + '=' + e + '&';
                }
            });
            return this.deleteLast(query);
        };

        /**
         * formatName
         * @param s
         * @returns {void|string}
         */
        Build.prototype.formatName = function (s) {
            return s.replace(/-[a-z]/gi, function (c) {
                return c.charAt(1).toUpperCase();
            });
        };


        /**
         * randoms
         * @param string
         * @param length
         * @returns {string}
         */
        Build.prototype.randoms = function (string, length) {
            var mathString = '';
            string = (string || '123456789abcdefghiKjklmnopqrvwxyzABCDEFGHIJKLMNOPQRVWXYZ').split('');
            length = length ? length : string.length;
            for (var i = 0; i < length; i++) {
                mathString += string[Math.ceil(Math.random() * (string.length - 1))];
            }
            return mathString;
        };

        Build.prototype.onlyId = function () {
        };

        /**
         * setCookie
         * @param name
         * @param value
         * @param time
         * @param path
         * @returns {string}
         */
        Build.prototype.setCookie = function (name, value, time, path) {
            var date = new Date(parseInt(this.getTime() + time) * 1000).toUTCString();
            return document.cookie = name + "=" + encodeURI(value) + (!time ? "" : "; expires=" + date) + (!path ? "" : "; path=" + path);
        };

        /**
         * getCookie
         * @param name
         * @returns {string}
         */
        Build.prototype.getCookie = function (name) {
            var cookies = document.cookie.split(";"), value = "";
            rapid.getBuild().each(cookies, function (i, e) {
                var data = rapid.getBuild().trimStr(e).split("=");
                if (data[0] === name) {
                    value = data[1];
                }
            });
            return value;
        };

        /**
         * trimStr
         * @param str
         * @returns {void|string|XML}
         */
        Build.prototype.trimStr = function (str) {
            return str.replace(/(^\s*)|(\s*$)/g, "");
        };

        /**
         * deleteFirst
         * @param string
         * @returns {string}
         */
        Build.prototype.deleteFirst = function (string) {
            return typeof string === 'string' ? string.substr(1) : '';
        };

        /**
         * deleteLast
         * @param string
         * @returns {string}
         */
        Build.prototype.deleteLast = function (string) {
            return typeof string === 'string' ? string.substr(0, string.length - 1) : '';
        };


        /**
         * getTime
         * @param length
         * @returns {Number}
         */
        Build.prototype.getTime = function (length) {
            length = length ? length : 10;

            const time = (new Date()).valueOf() + "";

            return parseInt(time.substr(0, length));
        };


        /**
         * 数字转10位
         * @param number
         * @returns {string}
         */
        function getTen(number) {
            return number < 10 ? '0' + number : number;
        }

        /**
         * 获取年月日
         * @returns {string}
         */
        Build.prototype.getDateYMD = function (date) {

            date = date || new Date();

            return date.getFullYear() + '-' + getTen(date.getMonth() + 1) + '-' + getTen(date.getDate());
        };

        /**
         * 获取时分秒
         * @param date
         * @returns {string}
         */
        Build.prototype.getDateHIS = function (date) {

            date = date || new Date();

            return getTen(date.getHours()) + ':' + getTen(date.getMinutes()) + ':' + getTen(date.getSeconds());
        };

        /**
         * 获取日期
         * @param time
         * @returns {string}
         */
        Build.prototype.getDate = function (time) {

            var date = new Date(parseInt(time) * 1000);

            return this.getDateYMD(date) + ' ' + this.getDateHIS(date);
        };


        /**
         * setAttr
         * @param object
         * @param parameter
         * @returns {*}
         */
        Build.prototype.setAttr = function (object, parameter) {
            this.each(parameter, function (i, e) {
                object[i] = e;
            });
            return object;
        };


        /**
         * getMTime
         * @param millisecond
         * @returns {{time: string, branch: string, second: string}}
         */
        Build.prototype.getMTime = function (millisecond) {
            var date = {time: "00", branch: "00", second: "00"};
            if (millisecond <= 0) return date;
            date.second = millisecond % 1000;
            date.second = (millisecond - date.second) / 1000;

            date.branch = date.second % 60;
            date.branch = (date.second - date.branch) / 60;

            date.time = date.branch % 60;
            date.time = (date.branch - date.time) / 60;

            date.second = date.second - date.branch * 60;
            date.branch = date.branch - date.time * 60;

            if (!date.time && !date.branch && !date.second) {
                return date;
            }
            return date;
        };

        /**
         * 对象转数组
         * @param obj
         * @returns {[]}
         */
        Build.prototype.objectToArray = function (obj) {
            let arr = [];

            for (let i in obj) if (obj.hasOwnProperty(i)) arr.push(obj[i]);

            return arr;
        };

        /**
         * callback
         * @param callback
         * @returns {null}
         */
        Build.prototype.callback = function (callback) {

            let param = arguments;

            delete param[0];

            return typeof callback === 'function' ? callback.apply(null, this.objectToArray(param)) : null;
        };

        /**
         * compatibleCss
         * @param style
         * @returns {Array}
         */
        Build.prototype.compatibleCss = function (style) {
            var prefix = ['', 'webkit', 'Moz', 'ms', 'o'], list = [];
            for (var i in prefix) {
                var name = this.formatName(prefix[i]);
                list.push((name ? name + '-' : "") + style);
            }
            return list;
        };

        /**
         * supportCss3
         * @param style
         * @returns {boolean}
         */
        Build.prototype.supportCss3 = function (style) {
            var htmlStyle = document.documentElement.style;
            var compatibleCss = this.compatibleCss(style);
            for (var i in compatibleCss) if (compatibleCss[i] in htmlStyle) return true;
            return false;
        };

        /**
         * getBrowserCssHead
         * @returns {*}
         */
        Build.prototype.getBrowserCssHead = function () {
            var userAgent = navigator.userAgent;
            if (userAgent.indexOf("Opera") > -1) {
                return "-o-"
            } else if (userAgent.indexOf("Firefox") > -1) {
                return "-Moz-";
            } else if (userAgent.indexOf("Chrome") > -1 || userAgent.indexOf("Safari") > -1) {
                return "-webkit-";
            } else if (userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera) {
                return "";
            }
        };

        /**
         * getObjectSize
         * @param object
         * @returns {number}
         */
        Build.prototype.getObjectSize = function (object) {
            var count = 0;
            if (typeof object === 'object') for (var i in object) count++;
            return count;
        };

        /**
         * getOS
         * @returns {string}
         */
        Build.prototype.getOS = function () {
            return /(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent) ? "Ios" : /(Android)/i.test(navigator.userAgent) ? "Android" : "Window";
        };


        /**
         * analysisViewFrame
         * @param view
         * @returns {*}
         */
        Build.prototype.analysisViewFrame = function (view) {
            return view ? view instanceof View ? [view.getView()] : view === document || view === window ? [view] : (typeof Element === 'function' || typeof Element === 'object') && view instanceof Element ? [view] : typeof view === 'object' && (typeof view.item === 'function' || typeof view.item === 'string' || typeof view.item === 'object' || view instanceof Array) ? view : view.toString() === '[object HTMLHtmlElement]' || view.toString() === '[object]' ? [view] : view : null;
        };

        /**
         * 获取get参数
         * @param name
         * @returns {string}
         */
        Build.prototype.getQueryString = function (name) {
            const reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");

            const r = window.location.search.substr(1).match(reg);

            return r ? decodeURIComponent(r[2] || "") : "";
        };

        /**
         * 字节转文本
         * @param bytes
         * @returns {string}
         */
        Build.prototype.bytesToSize = function (bytes) {
            if (bytes === 0) return '0 B';

            const k = 1000,
                sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                i = Math.floor(Math.log(bytes) / Math.log(k));

            return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
        };


        /**
         * 获取主url
         * @returns {string}
         */
        Build.prototype.getHostUrl = function () {
            let url = rapid.getGlobalConfigPathDir().split('/');

            url.pop();

            url.pop();

            return url.join('/') + '/';
        };

        /**
         * 对象扩展
         * @param original
         * @param extend
         * @returns {*}
         */
        Build.prototype.extend = function (original, extend) {
            for (let p in extend) {
                const o = original[p];

                const e = extend[p];

                if (o && typeof o === 'object' && e && typeof e === 'object') this.extend(o, e);

                original[p] = e;
            }

            return original;
        };

        return Build;
    })();


    rapid.Http = (function () {

        function Http(url, data) {
            this.url = url || '';
            this.data = data || {};
            this.httpRequest = createdXmlHttpRequest();
        }

        Http.METHOD_TYPE_GET = 'GET';

        Http.METHOD_TYPE_POST = 'POST';

        Http.METHOD_TYPE_GET = 'GET';

        /**
         * createdXmlHttpRequest
         * @returns {XMLHttpRequest}
         */
        function createdXmlHttpRequest() {
            return typeof XMLHttpRequest === 'object' || typeof XMLHttpRequest === 'function' ? new XMLHttpRequest() : typeof window.ActiveXObject === 'function' ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
        }

        /**
         * on Http Response Complete
         * @param http
         * @param call
         */
        function onHttpResponseComplete(http, call) {
            http.onreadystatechange = function () {
                if (http.readyState === 4) return closeCall(call, http.responseText, http);
            };
        }

        /**
         * on Http Error
         * @param http
         * @param call
         */
        function onHttpError(http, call) {
            http.onerror = function () {
                closeCall(call, http.responseText, http);
            };
        }

        /**
         * setHttpRequestPost
         * @param http
         * @param data
         */
        function setHttpRequestPost(http, data) {
            if (typeof FormData === 'function') {
                if (!(data instanceof FormData)) http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            } else {
                http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            }
        }

        /**
         * 设置http请求headers
         * @param http
         * @param headers
         */
        function setHttpRequestHeaders(http, headers) {
            rapid.getBuild().each(headers, function (name, value) {
                http.setRequestHeader(name, value);
            });
        }

        /**
         * getHttpRequest
         * @returns {*}
         */
        Http.prototype.getHttpRequest = function () {
            return this.httpRequest;
        };

        /**
         * textBody
         * @param text
         * @constructor
         */
        function textBody(text) {

            this.text = text;

            this.getBody = function () {
                return text || '';
            };

            this.toJSON = function () {
                return rapid.getBuild().toJson(this.getBody());
            };
        }

        /**
         * close Call
         * @param call:C
         * @param text
         * @param http
         */
        function closeCall(call, text, http) {
            if (typeof call === 'function') call.apply(null, [new textBody(text), http]);
        }

        /**
         * request
         * @param method
         * @param call
         * @param errorCall
         * @param headers
         */
        Http.prototype.request = function (method, call, errorCall, headers) {

            onHttpResponseComplete(this.httpRequest, call);

            onHttpError(this.httpRequest, errorCall || call);

            this.httpRequest.open(method, this.url, true);

            let data = this.data;

            if (method.toUpperCase() === Http.METHOD_TYPE_POST && !rapid.getBuild().getData(headers, 'Content-Type'))
                setHttpRequestPost(this.httpRequest, data);

            data = typeof FormData === 'function' && data instanceof FormData ? data : method.toUpperCase() === Http.METHOD_TYPE_POST ? rapid.getBuild().toUrlQuery(data) : '';

            setHttpRequestHeaders(this.httpRequest, headers);

            this.httpRequest.send(data);

            return this;
        };

        /**
         * get
         * @param call
         * @param errorCall
         * @param headers
         */
        Http.prototype.get = function (call, errorCall, headers) {
            return this.request(Http.METHOD_TYPE_GET, call, errorCall, headers);
        };

        /**
         * post
         * @param call
         * @param errorCall
         * @param headers
         */
        Http.prototype.post = function (call, errorCall, headers) {
            return this.request(Http.METHOD_TYPE_POST, call, errorCall, headers);
        };

        return Http;
    })();


    var FormVerify = (function () {

        var FORM_FUNC_TYPE_1 = 1;

        var FORM_FUNC_TYPE_2 = 2;

        var FORM_FUNC_TYPE_3 = 3;

        var FORM_ATTR_NAME_MSG = 'rapid-form-msg';

        var FORM_ATTR_NAME_ERRBYID = 'rapid-form-errId';

        var FORM_ATTR_NAME_FUNC = 'rapid-form-func';

        var FORM_ATTR_NAME_FILTER = 'rapid-form-filter';

        var FORM_ATTR_NAME_ISVALUE = 'rapid-form-isvalue';

        var FORM_ATTR_NAME_FUNCTYPE = 'rapid-form-func-type';

        var FORM_ATTR_NAME_CLASSNAME = 'show';

        var FORM_ATTR_NAME_INPUTNAME = 'name';

        var FORM_ATTR_NAME_NAME = 'rapid-form-name';

        var FORM_ATTR_NAME_GROUP = 'rapid-form-group';

        var FORM_ATTR_NAME_LIST = 'rapid-form-list';

        var FORM_ATTR_NAME_VALUE = 'rapid-form-value';

        function FormVerify(mainController, form, callback, data) {
            this.form = form;
            this.data = data || {};
            this.callback = callback;
            this.mainController = mainController;
        }

        /**
         * getFormViewList
         * @param form
         * @returns {Array}
         */
        function getFormViewList(form) {

            var viewList = [], i;

            var formNameViewList = form.find("*[data-" + FORM_ATTR_NAME_NAME + "]");

            var attrNameViewList = form.find("*[" + FORM_ATTR_NAME_INPUTNAME + "]");

            for (i = 0; i < attrNameViewList.frames.length; i++) viewList.push(attrNameViewList.frames[i]);

            for (i = 0; i < formNameViewList.frames.length; i++) viewList.push(formNameViewList.frames[i]);

            return viewList;
        }


        /**
         * getFormGroupView
         * @param inputView
         */
        function getFormGroupView(inputView) {
            var parent = inputView.getParent();
            if (parent.isFrame()) {
                if (parent.getView().hasAttribute("data-" + FORM_ATTR_NAME_GROUP)) {
                    return parent;
                } else {
                    return getFormGroupView(parent);
                }
            } else {
                return null;
            }
        }

        /**
         * getFormGroupInputName
         * @param inputView
         * @returns {string}
         */
        function getFormGroupInputName(inputView) {
            return inputView.getData(FORM_ATTR_NAME_NAME) || inputView.getAttr(FORM_ATTR_NAME_INPUTNAME);
        }

        /**
         * getVerifyFormViewValueFilter
         * @param filter
         * @param mainController
         * @returns {*}
         */
        function getVerifyFormViewValueFilter(filter, mainController) {

            if (typeof window[filter] === 'function') return window[filter];

            if (typeof mainController[filter] === 'function') return mainController[filter];

            return eval(filter);
        }

        /**
         * getVerifyFormViewValueFunc
         * @param func
         * @param mainController
         * @returns {*}
         */
        function getVerifyFormViewValueFunc(func, mainController) {

            if (typeof window[func] === 'function') return window[func];

            if (typeof mainController[func] === 'function') return mainController[func].bind(mainController);

            return false;
        }

        /**
         * 获取view 值
         * @param inputView
         * @returns {(View&HTMLInputElement)|HTMLInputElement|(View&HTMLInputElement)|*|string}
         */
        function getVerifyFormViewValue(inputView) {

            const value = inputView.getValue();

            const view = inputView.getView();

            if (view instanceof HTMLInputElement) {
                const type = (inputView.attr('type') || '').toLocaleUpperCase();

                if (type === 'FILE') return value ? view : null;
            }

            return value;
        }


        /**
         * getVerifyFormViewValueList
         * @param inputView
         * @param byId
         * @returns {Array}
         */
        function getVerifyFormViewValueList(inputView, byId) {

            var list = [], listView = inputView.find(byId);

            listView.each(function (view) {

                var formValue = view.getData(FORM_ATTR_NAME_VALUE);

                var value = formValue === null ? view.getValue() : formValue;

                if (value) list.push(value);
            });
            return list;
        }

        /**
         * getFormErrView
         * @param inputView
         * @param form
         * @returns {View|*}
         */
        function getFormErrView(inputView, form) {
            var groupView = getFormGroupView(inputView);

            var errById = inputView.getData(FORM_ATTR_NAME_ERRBYID) || groupView.getData(FORM_ATTR_NAME_ERRBYID) || form.getData(FORM_ATTR_NAME_ERRBYID);

            return groupView.find(errById);
        }

        /**
         * getFormFuncType
         * @param inputView
         * @param form
         * @returns {Number}
         */
        function getFormFuncType(inputView, form) {
            var funcType = inputView.getData(FORM_ATTR_NAME_FUNCTYPE) || form.getData(FORM_ATTR_NAME_FUNCTYPE) || FORM_FUNC_TYPE_1;

            return parseInt(funcType);
        }

        /**
         * getFormGroupInputValue
         * @param form
         * @param inputView
         * @param mainController
         * @returns {*}
         */
        function getFormGroupInputValue(form, inputView, mainController) {
            var listById = inputView.getData(FORM_ATTR_NAME_LIST);

            var formValue = inputView.getData(FORM_ATTR_NAME_VALUE);

            var value = listById === null ? formValue === null ? getVerifyFormViewValue(inputView) : formValue : getVerifyFormViewValueList(inputView, listById);

            var msg = inputView.getData(FORM_ATTR_NAME_MSG) || form.getData(FORM_ATTR_NAME_MSG);

            var errFunc = inputView.getData(FORM_ATTR_NAME_FUNC) || form.getData(FORM_ATTR_NAME_FUNC);

            var filter = inputView.getData(FORM_ATTR_NAME_FILTER) || form.getData(FORM_ATTR_NAME_FILTER);

            var isValue = inputView.getData(FORM_ATTR_NAME_ISVALUE) || form.getData(FORM_ATTR_NAME_ISVALUE);

            filter = getVerifyFormViewValueFilter(filter, mainController);

            errFunc = getVerifyFormViewValueFunc(errFunc, mainController);

            value = typeof filter === 'function' ? filter(value, inputView) : value;

            var errView = null, funcType = getFormFuncType(inputView, form);

            switch (funcType) {
                case FORM_FUNC_TYPE_1:
                    errFunc = errFunc ? errFunc : alert;
                    break;
                case FORM_FUNC_TYPE_2:
                    errView = getFormErrView(inputView, form);
                    break;
                case FORM_FUNC_TYPE_3:
                    errFunc = errFunc ? errFunc : alert;
                    errView = getFormErrView(inputView, form);
                    break;
            }

            if ((value === null || value === '') && isValue) {
                if (typeof errFunc === 'function') errFunc(msg || "", inputView);

                if (errView !== null) errView.addClass(FORM_ATTR_NAME_CLASSNAME);

                return false;
            } else {
                if (errView !== null) errView.removeClass(FORM_ATTR_NAME_CLASSNAME);
            }

            return value;
        }

        /**
         * bindViewList
         */
        FormVerify.prototype.bindViewList = function () {

            var self = this;

            var inputViewList = getFormViewList(this.form);

            rapid.getBuild().each(inputViewList, function (i, view) {

                var inputView = rapid.getView(view);

                var funcType = getFormFuncType(inputView, self.form);

                inputView.on("input", function () {
                    if (funcType === FORM_FUNC_TYPE_2) getFormGroupInputValue(self.form, inputView, self.mainController);
                });
            });
        };

        /**
         * verifyForm
         */
        FormVerify.prototype.verifyForm = function () {

            var errView = null;

            var inputViewList = getFormViewList(this.form);

            for (var i = 0; i < inputViewList.length; i++) {

                var inputView = rapid.getView(inputViewList[i]);

                var name = getFormGroupInputName(inputView);

                var value = getFormGroupInputValue(this.form, inputView, this.mainController);

                if (typeof value === 'boolean' && value === false) {
                    if (errView === null) errView = inputView;

                    if (getFormFuncType(inputView, this.form) !== FORM_FUNC_TYPE_2) return false;
                }

                this.data[name] = value;
            }

            if (errView !== null) {
                document.body.scrollTop = errView.getView().offsetTop - 100;
            } else {
                if (typeof this.callback === 'function') this.callback.call(this.mainController, this.data);
            }
        };

        return FormVerify;
    })();


    var Plugin = (function () {


        /**
         * Plugin
         * @constructor
         */
        function Plugin() {

        }

        /**
         * getPathLibs
         * @returns {string}
         */
        Plugin.getPathLibs = function () {
            return rapid.getGlobalConfigPathLibs();
        };

        /**
         * configs
         * @type {{Base64: string, Md5: string, Interface: string, jweixin: string}}
         */
        Plugin.configs = {
            "AppView": 'rapid/plugin/AppView.js',
            "Base64": 'rapid/plugin/Base64.js',
            "Interface": 'rapid/plugin/Interface.js',
            "Md5": 'rapid/plugin/Md5.js',
            "WxSdk": 'rapid/plugin/WxSdk.js',
            "PassPayView": 'rapid/plugin/PassPayView.js',
            "SelectView": 'rapid/plugin/SelectView.js',
            "jweixin": 'https://res2.wx.qq.com/open/js/jweixin-1.4.0.js'
        };


        /**
         * getAppView
         * @returns {*}
         */
        Plugin.getAppView = function () {
            return rapid.AppView;
        };

        /**
         * base64
         * @param string
         * @returns {rapid.Base64}
         */
        Plugin.getBase64 = function (string) {
            return new rapid.Base64(string);
        };

        /**
         * getInterface
         * @param name
         * @returns {rapid.Interface}
         */
        Plugin.getInterface = function (name) {
            return new rapid.Interface(name);
        };

        /**
         * md5
         * @param string
         * @returns {rapid.Md5}
         */
        Plugin.getMd5 = function (string) {
            return new rapid.Md5(string);
        };


        /**
         * getWxSDK
         * @param debug
         * @param callback
         * @param jsApiList
         * @returns {*}
         */
        Plugin.getWxSDK = function (debug, callback, jsApiList) {
            return new rapid.WxSdk(debug, callback, jsApiList);
        };

        /**
         * 获取密码输入框view
         * @param parent
         * @param call
         * @param count
         * @returns {*}
         */
        Plugin.getPassPayView = function (parent, call, count) {
            return new rapid.PassPayView(parent, call, count);
        };


        /**
         * 获取选择view
         * @param selectView
         * @returns {*}
         */
        Plugin.getSelectView = function (selectView) {
            return new rapid.SelectView(selectView);
        };

        /**
         * getConfig
         */
        Plugin.getConfig = function () {
            return this.configs;
        };


        /**
         * 获取path
         * @returns {string}
         */
        Plugin.getPath = function (name) {
            const path = rapid.getBuild().getData(this.configs, name);

            return (path ? path.match(/(http|https):\/\/.*/gi) ? path : this.getPathLibs() + path : name);
        };

        /**
         * Loading
         * @param name
         * @param callback
         * @constructor
         */
        Plugin.Loading = function (name, callback) {
            const self = this;

            require([self.getPath(name)], callback);
        };

        /**
         * Loadings
         * @param data
         * @param callback
         * @constructor
         */
        Plugin.Loadings = function (data, callback) {
            const self = this, model = [];

            for (let i in data) model.push(self.getPath(data[i]));

            require(model, callback);
        };

        return Plugin;
    })();


    const View = (function () {

        /**
         * View
         * @param view document,window,[html],[],Element
         * @constructor
         */
        function View(view) {
            this.frames = rapid.getBuild().analysisViewFrame(view);

            this.frame = this.frames !== null && typeof this.frames === "object" && this.frames.length >= 1 ? this.frames[0] : null;
        }


        /**
         * getView
         * @param byId
         * @param parent
         * @returns {NodeList}
         */
        function getView(byId, parent) {
            parent = parent || document;
            return typeof parent.querySelectorAll === 'object' || typeof parent.querySelectorAll === 'function' ? parent.querySelectorAll(byId) : null;
        }


        /**
         * createdView
         * @param name
         * @param value
         * @param attr
         * @param parent
         * @returns {View}
         */
        View.createdView = function (name, value, attr, parent) {
            var element = new View(document.createElement(name));

            if (value) element.setValue(value);

            if (attr) element.setAttr(attr);

            if (parent instanceof View) parent.addView(element);

            if (typeof parent === 'object' && typeof parent.appendChild === 'function') parent.appendChild(element.getView());

            return element;
        };

        /**
         * findViewById
         * @param byId
         * @param parent
         * @returns {View}
         */
        View.findViewById = function (byId, parent) {
            var view = typeof byId === 'string' ? getView(byId, parent) : typeof Element === 'function' && byId instanceof Element ? [byId] : byId;
            return new View(view);
        };

        /**
         * addViewTo
         * @param byId
         * @returns {View}
         */
        View.prototype.addViewTo = function (byId) {
            if (byId instanceof View) {
                byId.addView(this.frame);
            } else {
                View.findViewById(byId).addView(this.frame);
            }
            return this;
        };

        /**
         * length
         * @returns {number}
         */
        View.prototype.length = function () {
            return this.frames ? this.frames.length : 0;
        };

        /**
         * find
         * @param byId
         * @returns {View}
         */

        View.prototype.find = function (byId) {
            return View.findViewById(byId, this.frame);
        };

        /**
         * getParent
         * @returns {View}
         */
        View.prototype.getParent = function () {
            return new View(this.frame.parentNode);
        };

        /**
         * each
         * @param callback
         * @returns {View}
         */
        View.prototype.each = function (callback) {
            rapid.getBuild().each(this.frames, function (i, e) {
                typeof callback === 'function' ? callback(new View(e), i) : null;
            });
            return this;
        };


        /**
         * hasClass
         * @param className
         * @returns {Array|{index: number, input: string}}
         */
        View.prototype.hasClass = function (className) {
            return this.frame.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
        };

        /**
         * addClass
         * @param className
         * @returns {View}
         */
        View.prototype.addClass = function (className) {
            this.each(function (view) {
                if (!view.hasClass(className)) view.frame.className += " " + className;
            });
            return this
        };


        /**
         * removeClass
         * @param className
         * @returns {View}
         */
        View.prototype.removeClass = function (className) {
            var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
            this.each(function (view) {
                if (view.hasClass(className)) view.frame.className = view.frame.className.replace(reg, ' ');
            });
            return this
        };


        /**
         * toggleClass
         * @param className
         * @returns {View}
         */
        View.prototype.toggleClass = function (className) {
            if (this.hasClass(className)) {
                this.removeClass(className);
            } else {
                this.addClass(className);
            }
            return this;
        };


        /**
         * eachOn
         * @param on
         * @param callback
         * @returns {View}
         */
        View.prototype.eachOn = function (on, callback) {
            var self = this;
            return this.each(function (view, index) {
                typeof view[on] === 'function' ? view[on](function (event) {
                    typeof callback === 'function' ? callback(view, event, index, self) : null;
                }) : typeof on === 'string' ? view.on(on, function (event) {
                    typeof callback === 'function' ? callback(view, event, index, self) : null;
                }, false) : null;
            });
        };

        /**
         * isFrame
         * @param index
         * @returns {boolean}
         */
        View.prototype.isFrame = function (index) {
            index = index || 0;
            return typeof this.frames[index] === 'object' ? this.eq(index) : false;
        };

        /**
         * eq
         * @param index
         * @param error
         * @returns {View}
         */
        View.prototype.eq = function (index, error) {
            try {
                return new View(this.frames[index]);
            } catch (e) {
                typeof error === 'function' ? error(e) : null;
            }
        };

        /**
         * css
         * @param name
         * @param value
         * @returns {View}
         */
        View.prototype.css = function (name, value) {
            return this.setStyle(name, value);
        };

        /**
         * remove
         * @returns {Node}
         */
        View.prototype.remove = function () {
            return this.frame.parentNode.removeChild(this.frame);
        };

        /**
         * disable
         * @param result
         * @returns {View}
         */
        View.prototype.disable = function (result) {
            this.frame.disabled = result || true;
            return this;
        };

        /**
         * addView
         * @param newChild
         * @returns {View}
         */
        View.prototype.addView = function (newChild) {
            if (typeof newChild !== "object") {
                this.frame.innerHTML += newChild;
            } else {
                this.frame.appendChild(View.getViewFrame(newChild));
            }
            return this;
        };


        /**
         *createdView
         * @param name
         * @param value
         * @param attr
         * @param parent
         * @returns {View}
         */
        View.prototype.createdView = function (name, value, attr, parent) {
            return View.createdView(name, value, attr, parent ? parent : this.frame);
        };

        /**
         * setParent
         * @param parent
         * @returns {View}
         */
        View.prototype.setParent = function (parent) {
            if (parent instanceof View) {
                parent.addView(this.frame);
            } else if (typeof parent === 'object' && typeof parent.appendChild === 'function') {
                parent.appendChild(this.frame);
            }
            return this;
        };

        /**
         * removeView
         * @param oldChild
         * @returns {View}
         */
        View.prototype.removeView = function (oldChild) {
            this.frame.removeChild(View.getViewFrame(oldChild));
            return this;
        };


        /**
         * empty
         * @param newChild
         * @returns {View}
         */
        View.prototype.empty = function (newChild) {
            this.frame.innerHTML = '';
            if (newChild) this.addView(newChild);
            return this;
        };


        /**
         * getViewFrame
         * @param view
         * @returns {null|*}
         */
        View.getViewFrame = function (view) {
            return view instanceof View ? view.getView() : (typeof Element === 'function' || typeof Element === 'object') && view instanceof Element ? view : null;
        };

        /**
         * getHtml
         * @returns {*}
         */
        View.prototype.getHtml = function () {
            return this.frame.innerHTML;
        };


        /**
         * setHtml
         * @param value
         * @returns {View}
         */
        View.prototype.setHtml = function (value) {
            typeof value === 'object' ? this.addView(value) : this.frame.innerHTML = value;
            return this;
        };


        /**
         * html
         * @param value
         * @returns {*}
         */
        View.prototype.html = function (value) {
            return value == null ? this.getHtml() : this.setHtml(value);
        };


        /**
         * getView
         * @returns {null|*}
         */
        View.prototype.getView = function () {
            return this.frame;
        };


        /**
         * setValue
         * @param value
         * @returns {View}
         */
        View.prototype.setValue = function (value) {
            if (this.frame instanceof HTMLSelectElement) {
                this.frame.value = value;
            } else {
                typeof this.frame.src === 'string' && (this.frame instanceof HTMLInputElement && this.frame.type !== 'image') === false ? this.frame.src = value : typeof this.frame.value === 'string' ? this.frame.value = value : this.frame.innerHTML = value;
            }
            return this;
        };

        /**
         * getValue
         * @returns {*}
         */
        View.prototype.getValue = function () {
            if (this.frame instanceof HTMLSelectElement) return this.frame.value;
            return this.frame.src || this.frame.value || this.frame.innerHTML;
        };


        /**
         * get val
         * @param value
         * @returns {*}
         */
        View.prototype.val = function (value) {
            return value == null ? this.getValue() : this.setValue(value);
        };

        /**
         * getWidth
         * @returns {number}
         */
        View.prototype.getWidth = function () {
            return this.frame.clientWidth;
        };

        /**
         * getHeight
         * @returns {number}
         */
        View.prototype.getHeight = function () {
            return this.frame.clientHeight;
        };

        /**
         * 移除attr
         * @param name
         * @returns {View}
         */
        View.prototype.removeAttr = function (name) {
            this.frame.removeAttribute(name);
            return this;
        };

        /**
         * setAttr
         * @param name
         * @param value
         * @returns {View}
         */
        View.prototype.setAttr = function (name, value) {
            if (typeof name === 'object') for (var i in name) {
                this.frame.setAttribute(i, name[i])
            } else {
                this.frame.setAttribute(name, value);
            }
            return this;
        };

        /**
         * getAttr
         * @param name
         * @returns {string}
         */
        View.prototype.getAttr = function (name) {
            return this.frame.getAttribute(name);
        };

        /**
         * attr
         * @param name
         * @param value
         * @returns {*}
         */
        View.prototype.attr = function (name, value) {
            return value == null ? this.getAttr(name) : this.setAttr(name, value);
        };

        /**
         * offset
         * @returns {{top: number, left: number}}
         */
        View.prototype.offset = function () {
            var e = this.frame, a = e.getBoundingClientRect(), t = document.body, r = e.clientTop || t.clientTop || 0,
                i = e.clientLeft || t.clientLeft || 0, s = window.pageYOffset || e.scrollTop,
                n = window.pageXOffset || e.scrollLeft;
            return {top: a.top + s - r, left: a.left + n - i}
        };

        /**
         * setOffSet
         * @param top
         * @param left
         */
        View.prototype.setOffSet = function (top, left) {
            return this.setOffSetTop(top).setOffSetLeft(left);
        };

        /**
         * setOffSetTop
         * @param top
         * @returns {View}
         */
        View.prototype.setOffSetTop = function (top) {
            this.frame.offsetTop = top;
            return this;
        };

        /**
         * setOffSetLeft
         * @param left
         * @returns {View}
         */
        View.prototype.setOffSetLeft = function (left) {
            this.frame.offsetLeft = left;
            return this;
        };

        /**
         * 获取以data开头的属性
         * @param name
         * @returns {string}
         */
        View.prototype.getData = function (name) {
            return this.getAttr('data-' + name);
        };

        /**
         * 设置data属性
         * @param name
         * @param value
         * @returns {View}
         */
        View.prototype.setData = function (name, value) {
            if (typeof name === 'object') for (var i in name) {
                this.setAttr('data-' + i, name[i])
            } else {
                this.setAttr('data-' + name, value);
            }
            return this;
        };

        /**
         * data
         * @param name
         * @param value
         * @returns {*}
         */
        View.prototype.data = function (name, value) {
            return value == null && typeof name === 'string' ? this.getData(name) : this.setData(name, value);
        };

        /**
         * setObject
         * @param name
         * @param value
         * @returns {View}
         */
        View.prototype.setObject = function (name, value) {
            if (typeof name === 'object') for (var i in name) {
                this.frame[i] = name[i];
            } else {
                this.frame[name] = value;
            }
            return this;
        };

        /**
         * getObject
         * @param name
         * @returns {*}
         */
        View.prototype.getObject = function (name) {
            return this.frame[name];
        };

        /**
         * object
         * @param name
         * @param value
         * @returns {View}
         */
        View.prototype.object = function (name, value) {
            return value == null ? this.getObject(name) : this.setObject(name, value);
        };

        /**
         * setStyle
         * @param name
         * @param value
         * @returns {View}
         */
        View.prototype.setStyle = function (name, value) {
            if (typeof name === 'object') for (var i in name) {
                this.frame.style[i] = name[i]
            } else {
                this.frame.style[name] = value;
            }
            this.frame.style[name] = value;

            return this;
        };

        /**
         * getStyle
         * @param name
         * @returns {*}
         */
        View.prototype.getStyle = function (name) {
            return this.frame.style[name];
        };


        /**
         * on
         * @param on
         * @param callback
         * @param useCapture
         * @returns {View}
         */
        View.prototype.on = function (on, callback, useCapture) {
            const addEvent = typeof document.addEventListener !== "undefined" ? 'addEventListener' : 'attachEvent';

            if (!callback && typeof this.frame[on] === 'function') this.frame[on]();

            if (on) this.frame[addEvent](addEvent === 'attachEvent' ? "on" + on : on, callback, useCapture || true);

            return this;
        };


        /**
         * removeOn
         * @param on
         * @param callback
         * @param useCapture
         * @returns {View}
         */
        View.prototype.removeOn = function (on, callback, useCapture) {
            var addEvent = typeof document.removeEventListener !== "undefined" ? 'removeEventListener' : 'detachEvent';
            if (on) this.frame[addEvent](addEvent === 'detachEvent' ? "on" + on : on, callback, useCapture || true);
            return this;
        };

        /**
         * once
         * @param on
         * @param callback
         * @returns {View}
         */
        View.prototype.once = function (on, callback) {
            if (!callback && typeof this.frame[on] === 'function') this.frame[on]();

            if (on) this.frame["on" + on] = callback;

            return this;
        };

        /**
         * removeOnOne
         * @param on
         * @returns {View}
         */
        View.prototype.removeOnOne = function (on) {
            if (on) this.frame["on" + on] = null;
            return this;
        };


        /**
         * tap
         * @param callback
         * @returns {View}
         */
        View.prototype.tap = function (callback) {
            return this.on("ontouchstart" in document ? 'touchstart' : 'click', callback, false);
        };

        /**
         * removeTap
         * @param callback
         * @returns {View}
         */
        View.prototype.removeTap = function (callback) {
            return this.removeOn("ontouchstart" in document ? 'touchstart' : 'click', callback, false);
        };

        /**
         * removetap
         * @param callback
         * @returns {View}
         */
        View.prototype.removetap = function (callback) {
            return this.removeTap(callback);
        };


        /**
         * tapMove
         * @param callback
         * @returns {View}
         */
        View.prototype.tapMove = function (callback) {
            return this.on("ontouchmove" in document ? 'touchmove' : 'mousemove', callback, false);
        };

        /**
         * tapmove
         * @param callback
         * @returns {View}
         */
        View.prototype.tapmove = function (callback) {
            return this.tapMove(callback);
        };


        /**
         * removeTapMove
         * @param callback
         * @returns {View}
         */
        View.prototype.removeTapMove = function (callback) {
            return this.removeOn("ontouchmove" in document ? 'touchmove' : 'mousemove', callback, false);
        };

        /**
         * removetapmove
         * @param callback
         * @returns {View}
         */
        View.prototype.removetapmove = function (callback) {
            return this.removeTapMove(callback);
        };

        /**
         * tapEnd
         * @param callback
         * @returns {View}
         */
        View.prototype.tapEnd = function (callback) {
            return this.on("ontouchend" in document ? 'touchend' : 'mouseup', callback, false);
        };

        /**
         * tapend
         * @param callback
         * @returns {View}
         */
        View.prototype.tapend = function (callback) {
            return this.tapEnd(callback);
        };

        /**
         * removeTapEnd
         * @param callback
         * @returns {View}
         */
        View.prototype.removeTapEnd = function (callback) {
            return this.removeOn("ontouchend" in document ? 'touchend' : 'mouseup', callback, false);
        };

        /**
         * removetapend
         * @param callback
         */
        View.prototype.removetapend = function (callback) {
            return this.removetapend(callback);
        };


        /**
         * tapCancel
         * @param callback
         * @returns {View}
         */
        View.prototype.tapCancel = function (callback) {
            return this.on("ontouchcancel" in document ? 'touchcancel' : 'mouseleave', callback, false);
        };

        /**
         * tapcancel
         * @param callback
         * @returns {View}
         */
        View.prototype.tapcancel = function (callback) {
            return this.tapCancel(callback);
        };


        /**
         * removeTapCancel
         * @param callback
         * @returns {View}
         */
        View.prototype.removeTapCancel = function (callback) {
            return this.removeOn("ontouchcancel" in document ? 'touchcancel' : 'mouseleave', callback, false);
        };


        /**
         * removetapcancel
         * @param callback
         * @returns {View}
         */
        View.prototype.removetapcancel = function (callback) {
            return this.removeTapCancel(callback);
        };

        /**
         * click
         * @param callback
         * @returns {View}
         */
        View.prototype.click = function (callback) {
            return this.on("click", callback, false);
        };

        /**
         * hover
         * @param inCallback
         * @param outCallback
         * @returns {View}
         */
        View.prototype.hover = function (inCallback, outCallback) {
            return this.on('mouseover', inCallback).on('mouseout', outCallback);
        };

        /**
         * focus
         * @param callback
         * @returns {View}
         */
        View.prototype.focus = function (callback) {
            return this.on("focus", callback, false);
        };


        /**
         * change
         * @param callback
         * @returns {View}
         */
        View.prototype.change = function (callback) {
            return this.on("change", callback, false);
        };


        /**
         * animate
         * @param style
         * @param time
         * @param callback
         * @param animateFunc
         */
        View.prototype.animate = function (style, time, callback, animateFunc) {
            return new Animate(this.frame, style, time, animateFunc || Animate.Tween.Linear).start(callback);
        };

        /**
         * getCssStyle
         * @param name
         * @returns {string}
         */
        View.prototype.getCssStyle = function (name) {
            var value = getCssStyleDefault(this.frame, name) || getCssStyleIe(this.frame, name);
            return value === 'auto' ? '0px' : value;
        };

        function getCssStyleIeOpacity(curStyle) {
            if (/alpha\(opacity=(.*)\)/i.test(curStyle.filter)) {
                var opacity = parseFloat(RegExp.$1);
                return opacity ? opacity / 100 : 0;
            }
            return 1;
        }

        function getCssStyleIeValue(element, style, name, curStyle) {
            var value = curStyle[name] || curStyle[rapid.getBuild().formatName(name)];
            if (!/^-?\d+(?:px)?$/i.test(value) && /^\-?\d/.test(value)) {
                var left = style.left, rtStyle = element.runtimeStyle, rsLeft = rtStyle.left;
                rtStyle.left = curStyle.left;
                style.left = value || 0;
                style.left = left;
                rtStyle.left = rsLeft;
            }
            return value;
        }

        function getCssStyleDefault(element, name) {
            if (!document.defaultView) return false;

            var style = document.defaultView.getComputedStyle(element, null);

            return name in style ? style[name] : style.getPropertyValue(name);
        }

        function getCssStyleIe(element, name) {
            var style = element.style, curStyle = element.currentStyle;

            if (name === "opacity") return getCssStyleIeOpacity(curStyle);

            if (name === "float") name = "styleFloat";

            return getCssStyleIeValue(element, style, name, curStyle);
        }


        /**
         * getIFrame
         * @returns {*}
         */
        View.prototype.getIFrame = function () {
            var self = this;
            var iFrame = self.frame;
            iFrame.getDocument = function () {
                return self.frame.contentDocument;
            }, iFrame.getWindow = function () {
                return self.frame.contentWindow;
            }, iFrame.getView = function () {
                return new View(self.frame.contentDocument.documentElement);
            };
            return iFrame;
        };

        /**
         * getMatchAttr
         * @param name
         * @returns {Array}
         */
        View.prototype.getMatchAttr = function (name) {
            var attributes = this.frame.attributes, list = [];
            for (var i = 0; i < attributes.length; i++) {
                var value = attributes[i];
                if (value.name.indexOf(name) !== -1) list.push(value);
            }
            return list;
        };

        return View;
    })();


    var Animate = (function () {

        Animate.Tween = {};

        Animate.Tween.Linear = function (start, alter, curTime, dur) {
            return start + curTime / dur * alter;
        };

        Animate.Tween.Quad = {};

        Animate.Tween.Quad.easeIn = function (start, alter, curTime, dur) {
            return start + Math.pow(curTime / dur, 2) * alter;
        };

        Animate.Tween.Quad.easeOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur;
            return start - (Math.pow(progress, 2) - 2 * progress) * alter;
        };

        Animate.Tween.Quad.easeInOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur * 2;
            return (progress < 1 ? Math.pow(progress, 2) : -((--progress) * (progress - 2) - 1)) * alter / 2 + start;
        };

        Animate.Tween.Cubic = {};

        Animate.Tween.Cubic.easeIn = function (start, alter, curTime, dur) {
            return start + Math.pow(curTime / dur, 3) * alter;
        };

        Animate.Tween.Cubic.easeOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur;
            return start - (Math.pow(progress, 3) - Math.pow(progress, 2) + 1) * alter;
        };

        Animate.Tween.Cubic.easeInOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur * 2;
            return (progress < 1 ? Math.pow(progress, 3) : ((progress -= 2) * Math.pow(progress, 2) + 2)) * alter / 2 + start;
        };

        Animate.Tween.Quart = {};

        Animate.Tween.Quart.easeIn = function (start, alter, curTime, dur) {
            return start + Math.pow(curTime / dur, 4) * alter;
        };

        Animate.Tween.Quart.easeOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur;
            return start - (Math.pow(progress, 4) - Math.pow(progress, 3) - 1) * alter;
        };

        Animate.Tween.Quart.easeInOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur * 2;
            return (progress < 1 ? Math.pow(progress, 4) : -((progress -= 2) * Math.pow(progress, 3) - 2)) * alter / 2 + start;
        };

        Animate.Tween.Quint = {};

        Animate.Tween.Quint.easeIn = function (start, alter, curTime, dur) {
            return start + Math.pow(curTime / dur, 5) * alter;
        };
        Animate.Tween.Quint.easeOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur;
            return start - (Math.pow(progress, 5) - Math.pow(progress, 4) + 1) * alter;
        };
        Animate.Tween.Quint.easeOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur * 2;
            return (progress < 1 ? Math.pow(progress, 5) : ((progress -= 2) * Math.pow(progress, 4) + 2)) * alter / 2 + start;
        };

        Animate.Tween.Sine = {};

        Animate.Tween.Sine.easeIn = function (start, alter, curTime, dur) {
            return start - (Math.cos(curTime / dur * Math.PI / 2) - 1) * alter;
        };

        Animate.Tween.Sine.easeOut = function (start, alter, curTime, dur) {
            return start + Math.sin(curTime / dur * Math.PI / 2) * alter;
        };

        Animate.Tween.Sine.easeInOut = function (start, alter, curTime, dur) {
            return start - (Math.cos(curTime / dur * Math.PI / 2) - 1) * alter / 2;
        };

        Animate.Tween.Expo = {};

        Animate.Tween.Expo.easeIn = function (start, alter, curTime, dur) {
            return curTime ? (start + alter * Math.pow(2, 10 * (curTime / dur - 1))) : start;
        };

        Animate.Tween.Expo.easeOut = function (start, alter, curTime, dur) {
            return (curTime === dur) ? (start + alter) : (start - (Math.pow(2, -10 * curTime / dur) + 1) * alter);
        };

        Animate.Tween.Expo.easeInOut = function (start, alter, curTime, dur) {
            if (!curTime) return start;
            if (curTime === dur) return start + alter;
            var progress = curTime / dur * 2;
            return progress < 1 ? alter / 2 * Math.pow(2, 10 * (progress - 1)) + start : alter / 2 * (-Math.pow(2, -10 * --progress) + 2) + start;
        };

        Animate.Tween.Circ = {};

        Animate.Tween.Circ.easeIn = function (start, alter, curTime, dur) {
            return start - alter * Math.sqrt(-Math.pow(curTime / dur, 2));
        };

        Animate.Tween.Circ.easeOut = function (start, alter, curTime, dur) {
            return start + alter * Math.sqrt(1 - Math.pow(curTime / dur - 1));
        };

        Animate.Tween.Circ.easeInOut = function (start, alter, curTime, dur) {
            var progress = curTime / dur * 2;
            return (progress < 1 ? 1 - Math.sqrt(1 - Math.pow(progress, 2)) : (Math.sqrt(1 - Math.pow(progress - 2, 2)) + 1)) * alter / 2 + start;
        };

        Animate.Tween.Elastic = {};

        Animate.Tween.Elastic.easeIn = function (start, alter, curTime, dur, extent, cycle) {
            if (!curTime) return start;
            if (curTime === dur) return start + alter;
            if (!cycle) cycle = dur * 0.3;
            var s;
            if (!extent || extent < Math.abs(alter)) {
                extent = alter;
                s = cycle / 4;
            } else {
                s = cycle / (Math.PI * 2) * Math.asin(alter / extent);
            }
            return start - extent * Math.pow(2, 10 * (curTime / dur - 1)) * Math.sin((curTime - dur - s) * (2 * Math.PI) / cycle);
        };

        Animate.Tween.Elastic.easeOut = function (start, alter, curTime, dur, extent, cycle) {
            if (!curTime) return start;
            if (curTime === dur) return start + alter;
            if (!cycle) cycle = dur * 0.3;
            var s;
            if (!extent || extent < Math.abs(alter)) {
                extent = alter;
                s = cycle / 4;
            } else {
                s = cycle / (Math.PI * 2) * Math.asin(alter / extent);
            }
            return start + alter + extent * Math.pow(2, -curTime / dur * 10) * Math.sin((curTime - s) * (2 * Math.PI) / cycle);
        };

        Animate.Tween.Elastic.easeInOut = function (start, alter, curTime, dur, extent, cycle) {
            if (!curTime) return start;
            if (curTime === dur) return start + alter;
            if (!cycle) cycle = dur * 0.45;
            var s;
            if (!extent || extent < Math.abs(alter)) {
                extent = alter;
                s = cycle / 4;
            } else {
                s = cycle / (Math.PI * 2) * Math.asin(alter / extent);
            }
            var progress = curTime / dur * 2;
            if (progress < 1) {
                return start - 0.5 * extent * Math.pow(2, 10 * (progress -= 1)) * Math.sin((progress * dur - s) * (2 * Math.PI) / cycle);
            } else {
                return start + alter + 0.5 * extent * Math.pow(2, -10 * (progress -= 1)) * Math.sin((progress * dur - s) * (2 * Math.PI) / cycle);
            }
        };

        Animate.Tween.Back = {};

        Animate.Tween.Back.easeIn = function (start, alter, curTime, dur, s) {
            if (typeof s === "undefined") s = 1.70158;
            return start + alter * (curTime /= dur) * curTime * ((s + 1) * curTime - s);
        };

        Animate.Tween.Back.easeOut = function (start, alter, curTime, dur, s) {
            if (typeof s === "undefined") s = 1.70158;
            return start + alter * ((curTime = curTime / dur - 1) * curTime * ((s + 1) * curTime + s) + 1);
        };

        Animate.Tween.Back.easeInOut = function (start, alter, curTime, dur, s) {
            if (typeof s === "undefined") s = 1.70158;
            if ((curTime /= dur / 2) < 1) {
                return start + alter / 2 * (Math.pow(curTime, 2) * (((s *= (1.525)) + 1) * curTime - s));
            }
            return start + alter / 2 * ((curTime -= 2) * curTime * (((s *= (1.525)) + 1) * curTime + s) + 2);
        };

        Animate.Tween.Bounce = {};

        Animate.Tween.Bounce.easeIn = function (start, alter, curTime, dur) {
            return start + alter - Animate.Tween.Bounce.easeOut(0, alter, dur - curTime, dur);
        };

        Animate.Tween.Bounce.easeOut = function (start, alter, curTime, dur) {
            if ((curTime /= dur) < (1 / 2.75)) {
                return alter * (7.5625 * Math.pow(curTime, 2)) + start;
            } else if (curTime < (2 / 2.75)) {
                return alter * (7.5625 * (curTime -= (1.5 / 2.75)) * curTime + .75) + start;
            } else if (curTime < (2.5 / 2.75)) {
                return alter * (7.5625 * (curTime -= (2.25 / 2.75)) * curTime + .9375) + start;
            } else {
                return alter * (7.5625 * (curTime -= (2.625 / 2.75)) * curTime + .984375) + start;
            }
        };

        Animate.Tween.Bounce.easeInOut = function (start, alter, curTime, dur) {
            if (curTime < dur / 2) {
                return Animate.Tween.Bounce.easeIn(0, alter, curTime * 2, dur) * 0.5 + start;
            } else {
                return Animate.Tween.Bounce.easeOut(0, alter, curTime * 2 - dur, dur) * 0.5 + alter * 0.5 + start;
            }
        };

        Animate.Tween.Bounce.easeOutBounce = function (b, c, t, d) {
            if ((t /= d) < (1 / 2.75)) {
                return c * (7.5625 * t * t) + b;
            } else if (t < (2 / 2.75)) {
                return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
            } else if (t < (2.5 / 2.75)) {
                return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
            } else {
                return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
            }
        };

        Animate.Tween.easeOutBounce = function (b, c, t, d) {
            if ((t /= d) < (1 / 2.75)) {
                return c * (7.5625 * t * t) + b;
            } else if (t < (2 / 2.75)) {
                return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
            } else if (t < (2.5 / 2.75)) {
                return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
            } else {
                return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
            }
        };


        function Animate(view, style, time, animateFunc) {
            this.setView(view).setStyle(style).setTime(time).setAnimateFunc(animateFunc);
            for (var i in this.view) if (!this[i]) this[i] = this.view[i];
        }

        Animate.prototype.setView = function (view) {
            this.view = view instanceof View ? view : view instanceof Element ? new View(view) : function () {
                throw new Error('view error' + view.toString());
            }();
            return this;
        };

        Animate.prototype.setStyle = function (style) {
            this.style = style;
            return this;
        };

        Animate.prototype.setTime = function (time) {
            this.time = time;
            return this;
        };

        Animate.prototype.setAnimateFunc = function (animateFunc) {
            this.animateFunc = animateFunc;
            return this;
        };


        var requestAnimationFrame = window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            window.oRequestAnimationFrame || function (callback) {
                setTimeout(callback, 16.7);
            };

        var cancelAnimationFrame = window.cancelAnimationFrame ||
            window.webkitCancelAnimationFrame ||
            window.mozCancelAnimationFrame ||
            window.msCancelAnimationFrame ||
            window.oCancelAnimationFrame || clearTimeout;


        /**
         * animateFrame
         * @param callback
         * @returns {Animate}
         */
        Animate.prototype.animateFrame = function (callback) {
            var self = this, totalTime = 0, start = {}, alter = {}, animateValue, match, company, i;


            function update() {
                return self.raf = requestAnimationFrame(function () {
                    if (totalTime >= self.time) return self.view.css(self.style) && cancelAnimationFrame(self.raf) || typeof callback === 'function' ? callback(self) : null;

                    for (i in self.style) {
                        if (!(i in start)) start[i] = parseFloat(self.view.getCssStyle(i));
                        if (!(i in alter)) alter[i] = parseFloat(self.style[i]) - start[i];
                        animateValue = self.animateFunc(start[i], alter[i], totalTime, self.time);
                        if (i === 'opacity') {
                            if (typeof self.view.getStyle('opacity') === "undefined") {
                                self.view.setStyle('filter', "alpha(opacity=" + animateValue * 100 + ")");
                            } else {
                                self.view.setStyle(i, animateValue);
                            }
                        } else {
                            match = self.style[i].toString().match(/([a-z][A-Z]|%)$/gi);
                            company = match ? match[0] : 'px';
                            if (typeof self.view.getView().style[i] !== 'undefined') {
                                self.view.css(i, animateValue + company);
                            } else {
                                self.view.setObject(i, animateValue + company);
                            }
                        }
                    }
                    totalTime += 16.7;
                    update();
                });
            }

            update();
            return this;
        };

        Animate.prototype.start = function (callback) {
            return this.animateFrame(callback);
        };

        Animate.prototype.stop = function (callback) {
            cancelAnimationFrame(this.raf) || typeof callback === 'function' ? callback(this) : null;
            return this;
        };

        return Animate;
    })();


    rapid.ATween = Animate.Tween;

    window.Controller = (function () {


        /**
         * controller
         * @constructor
         */
        function Controller() {
            this.view = new View(document.body);
        }


        /**
         * onCreate
         */
        Controller.prototype.onCreate = function () {

        };


        /**
         * onSwitchShow->显示当前界面调用的方法，子类可重写
         * @param appView
         */
        Controller.prototype.onSwitchShow = function (appView) {
            appView({left: 0}, 300);
        };


        /**
         * onSwitchOver->切换完毕
         * @param arg
         * @param controller
         */
        Controller.prototype.onSwitchOver = function (arg, controller) {

        };


        /**
         * onSwitchHide->隐藏当前界面调用的方法，子类可重写
         * @param appView
         */
        Controller.prototype.onSwitchHide = function (appView) {
            appView({left: "-100%"}, 300);
        };

        /**
         * onSwitchBack->返回完毕
         * @param arg
         * @param controller
         */
        Controller.prototype.onSwitchBack = function (arg, controller) {

        };

        /**
         * getParent
         * @returns {Window}
         */
        Controller.prototype.getParent = function () {
            return typeof window.parent === 'object' ? window.parent : window;
        };


        /**
         * getMainController
         * @returns {string}
         */
        Controller.prototype.getMainController = function () {
            return this.getParent().rapid.getMainController();
        };


        /**
         * getControllers
         * @param view
         * @returns {Array}
         */
        Controller.getControllers = function (view) {
            const names = view.getAttr(rapid.getGlobalConfig().dataNames.controllerName);

            return names !== null && typeof names === 'string' ? names.split("|") : [];
        };


        /**
         * getControllerMain
         * @param view
         * @param controllers
         * @returns {*}
         */
        Controller.getControllerMain = function (view, controllers) {
            const controllerName = controllers[controllers.length - 1];

            const main = view.getAttr(rapid.getGlobalConfig().dataNames.controllerMain);

            const controller = main ? main : typeof controllerName === 'string' && controllerName !== '' ? controllers[controllers.length - 1] : controllerName;

            const name = controller && typeof controller === 'string' ? controller.split(/([\/\\])/i).pop() : controller;

            return getUriInfo(name).fileName;
        };


        return Controller;
    })();


    const BindViewController = (function () {

        let self;

        function BindViewController() {
            self = this;

            self.varList = {};

            self.mainController = rapid.getGlobalConfigMainController();

            initViewBindObject();
        }

        BindViewController.prototype.getBindViewList = function () {
            const list = [];

            const view = rapid.getView("*[data-rapid]");

            view.each(function (view) {
                const rapid = view.data("rapid");

                if (!rapid) return list.push(view);

                const setAttrList = {};

                const parentAttrList = self.getViewAttrList(view);

                for (let i = 0; i < parentAttrList.length; i++) setAttrList[parentAttrList[i].attrName] = parentAttrList[i].value;

                view.find(rapid).each(function (view) {
                    list.push(view.setAttr(setAttrList));
                });
            });

            return new View(list);
        };

        BindViewController.prototype.getViewAttrList = function (view) {
            const attrName = "data-rapid-";

            const attrList = view.getMatchAttr(attrName), result = [];

            for (let i = 0; i < attrList.length; i++) {
                const list = attrList[i], listName = list.name.replace(attrName, "");

                if (list.name !== attrName && list.name) {
                    const data = analysisViewAttrList(listName);

                    data.value = list.value;

                    data.attrName = list.name;

                    result.push(data);
                }
            }
            return result;
        };


        function analysisViewAttrList(name) {
            const result = /(\w+)(\-|)(.*)/gi.exec(name);

            return {type: result[1], name: rapid.getBuild().formatName(result[3])};
        }

        function analysisValue(value) {
            const analysis = value.match(/(\w+)(\.|)(\(.*\)|)/gi);

            const analysisMethod = /(\w+)(\((.*)\)|)/gi.exec(analysis[analysis.length - 1] || "");

            return {
                methodName: analysisMethod[1] || "",
                object: analysisValueObject(analysisMethod[1] || ""),
                methodParam: analysisValueParam(analysisMethod[3] || "")
            };
        }


        function getArguments() {
            return arguments;
        }

        function analysisValueObject(methodName) {
            return typeof self.mainController[methodName] === 'function' ? self.mainController : window;
        }


        function analysisValueParam(methodParam) {
            return eval("getArguments(" + methodParam + ")");
        }


        function callViewEvent(view, on, callback) {
            typeof view[on] === 'function' ? view[on](callback) : view.on(on, callback);
        }


        function setMethodParamEV(methodParam, e, view) {
            const list = [];

            for (let i in methodParam) list.push(methodParam[i]);

            list.push(e);

            list.push(view);

            return list;
        }

        BindViewController.prototype.on = function (view, name, value) {
            const analysis = analysisValue(value);

            callViewEvent(view, name, function (e) {
                if (typeof analysis.object[analysis.methodName] === 'function') {
                    let param = analysis.methodParam;

                    if (analysis.object !== window) param = setMethodParamEV(analysis.methodParam, e, view);

                    analysis.object[analysis.methodName].apply(analysis.object, param);
                }
            });
        };

        BindViewController.prototype.form = function (view, name, value) {
            if (name) return false;

            const data = rapid.getBuild().toJson(value);

            const formSubmit = view.find("*[data-rapid-form-submit]");

            formSubmit.each(function (submitView) {

                let formCallback = submitView.data("rapid-form-submit");

                let formStartSubmit = submitView.data("rapid-form-submit-start");

                const formSubmitOnType = submitView.data("rapid-form-submit-on-type") || 'click';

                formCallback = typeof self.mainController[formCallback] === 'function' ? self.mainController[formCallback] : window[formCallback];

                formStartSubmit = typeof self.mainController[formStartSubmit] === 'function' ? self.mainController[formStartSubmit] : window[formStartSubmit];

                const formVerify = new FormVerify(self.mainController, view, formCallback, data);

                formVerify.bindViewList();

                submitView.on(formSubmitOnType, function () {
                    if (typeof formStartSubmit === 'function') if (formStartSubmit.apply(self.mainController, [view]) === true) return formVerify.verifyForm();

                    formVerify.verifyForm();
                })

            }.bind(this));
        };

        const vars = {};

        BindViewController.prototype.var = function (view, name, value) {
            if (name) return false;

            !vars[value] ? vars[value] = [view] : vars[value].push(view);

            if (self.mainController !== null && typeof self.mainController === 'object') {
                if (vars[value].length <= 1) {
                    self.mainController[value] = view;
                } else {
                    self.mainController[value] = new View(vars[value]);
                }
            }
        };

        function analysisInitVarList(value) {
            const varList = value !== null ? value.split(";") : [], list = [];

            for (let i = 0; i < varList.length; i++) {
                const v = varList[i] ? varList[i].split("=") : null;

                if (v !== null) {
                    list.push({
                        name: v[0],
                        value: v[1]
                    });
                }
            }
            return list;
        }

        function initViewBindObject() {
            const viewList = self.getBindViewList();

            viewList.each(function (view) {
                const attrList = self.getViewAttrList(view);

                for (let i = 0; i < attrList.length; i++) {

                    const list = attrList[i], call = self[list.type];

                    if (typeof call === 'function') call(view, list.name, list.value);
                }
            });
        }

        return BindViewController;
    })();

    return rapid;
})();

const rapidJs = document.getElementById("rapidJs");

if (rapidJs !== null && typeof rapidJs === 'object' && rapidJs.onload === null) new rapid(rapidJs, true);