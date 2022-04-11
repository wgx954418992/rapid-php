const BaseController = (function (controller) {

    rapid.__extends(BaseController, controller);

    function BaseController() {
        controller.apply(this, arguments);

        window.BC = this;
    }

    /**
     * formView
     * @type {View}
     */
    BaseController.prototype.formView = null;

    /**
     * config
     * @type {*}
     */
    BaseController.prototype.config = null;

    /**
     * on create
     */
    BaseController.prototype.onCreate = function () {
        this.create();
    };

    /**
     * on config init complete
     * @param config
     */
    BaseController.prototype.onConfigInitComplete = function (config) {

    };

    /**
     * create
     */
    BaseController.prototype.create = function () {

        this.tooltip();

        this.initConfig();

        this.initImageLazy();

        this.initFormView();

        this.initSwiper();

        this.initLayDate();

        this.initLayFrame();

        this.initICheck();
    };

    /**
     * tooltip
     */
    BaseController.prototype.tooltip = function () {
        if (typeof $ === 'function') $("[data-toggle='tooltip']").tooltip({html: true});
    };

    /**
     * init config
     */
    BaseController.prototype.initConfig = function () {
        const key = rapid.getGlobalConfigPathDir() + '__config__';

        console.log(key)

        let config = rapid.getBuild().toJson(localStorage.getItem(key));

        if (self === top) {
            const rapidJs = rapid.getView('#rapidJs');

            if (rapidJs.isFrame()) {
                let currentConfig = rapid.getBuild().toJson(decodeURIComponent(rapidJs.data('app-config')));

                if (currentConfig) config = currentConfig;
            }
        }

        if (!config) return;

        this.config = config;

        localStorage.setItem(key, JSON.stringify(config));

        this.onConfigInitComplete(config);
    }

    /**
     * init image lazy
     */
    BaseController.prototype.initImageLazy = function () {
        if (typeof $.fn.lazyload === 'function') {
            $("img.lazy").lazyload({effect: "fadeIn"});
        }
    }

    /**
     * init formView
     */
    BaseController.prototype.initFormView = function () {
        this.formView = rapid.getView().createdView("form")
            .attr("method", "POST")
            .attr("enctype", "multipart/form-data");
    };

    /**
     * init swiper
     */
    BaseController.prototype.initSwiper = function () {
        if (typeof Swiper !== 'function') return

        rapid.getView('.app-swiper').each(function (view) {
            new Swiper(view.getView());
        });
    };


    /**
     * initLayDate
     */
    BaseController.prototype.initLayDate = function () {
        if (typeof laydate === 'object') {
            rapid.getView('.laydate-icon').each(function (view) {
                let laydateData = view.data('laydate');

                let param = {elem: view.getView(), value: view.getValue(), trigger: 'click'};

                if (laydateData) {
                    try {
                        Object.assign(param, JSON.parse(laydateData));
                    } catch (e) {
                        Object.assign(param, laydateData);
                    }
                }

                laydate.render(param);
            });
        }
    };

    /**
     * initLayFrame
     */
    BaseController.prototype.initLayFrame = function () {
        rapid.getView('a[data-iframe]').each(function (view) {
            if (!parent.layer) return;

            const href = view.attr('href');

            view.removeAttr('href');

            view.click(function () {
                parent.layer.open({
                    type: 2,
                    title: view.data('frame') || view.data('text') || view.data('original-title') || view.attr('title') || view.getValue(),
                    shadeClose: true,
                    shade: false,
                    maxmin: true, //开启最大化最小化按钮
                    area: [view.data('w') || '60%', view.data('h') || '60%'],
                    content: href
                });
            });
        });
    };

    /**
     * 初始化icheck
     */
    BaseController.prototype.initICheck = function () {
        const view = $('.i-checks');

        if (typeof view.iCheck === 'function') {
            view.iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    };

    /**
     * 初始化Switch
     */
    BaseController.prototype.initSwitch = function () {
        if (typeof $ !== 'function') return;

        $('.switch-btn').on('change', function () {
            const that = $(this);

            const is = that.is(':checked') ? 1 : 0;

            const path = that.data('path');

            BC.sendUnifiedApi(path, {is: is}, function () {

            });
        });
    };

    /**
     * 初始化 summernote
     */
    BaseController.prototype.initSummernote = function (id) {
        if (typeof $ !== 'function') return;

        const that = this;

        id = id || "#summernote";

        const view = $(id).summernote({
            lang: "zh-CN",
            height: 200,
            callbacks: {
                onImageUpload: function (files) {
                    that.summernoteUploadImage(view, files);
                },
            },
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });

        view.summernote('insertText', '');

        return view;
    };

    /**
     * 初始化input 搜索
     * @param url
     * @param id
     * @param fields
     * @param alias
     * @param handle
     */
    BaseController.prototype.initInputSearch = function (url, id, fields, alias, handle) {
        if (typeof $ !== 'function') return;

        $(id).bsSuggest({
            indexId: 0,
            indexKey: 1,
            clearable: true,
            ignorecase: true,
            allowNoKeyword: true,
            multiWord: false,
            separator: ",",
            getDataMethod: "url",
            effectiveFields: fields,
            effectiveFieldsAlias: alias,
            showHeader: true,
            delayUntilKeyup: true,
            url: url,
            processData: function (json) {
                const data = {value: []};

                let list = [];

                if (typeof handle === 'function') {
                    list = handle(json);
                } else {
                    if (json.code !== 1) return data;

                    list = json.data;
                }

                for (let v of list) {
                    const d = {};

                    for (let filed of fields) {
                        if (v.hasOwnProperty(filed)) d[filed] = v[filed];
                    }

                    data.value.push(d);
                }

                return data;
            }
        })
    };


    /**
     * 数据加载动画
     * @param text
     * @param isTouch
     * @return {View}
     */
    BaseController.prototype.loadingToast = function (text, isTouch) {
        const loading = rapid.getView().createdView("div").setParent(document.body)
            .css('background', 'rgba(0,0,0,0.4)').css("zIndex", 9998)
            .addClass("rapid-loading-toast");

        const toast = rapid.getView().createdView("div").setParent(loading)
            .addClass("rapid-toast");

        const animation = rapid.getView().createdView("div").setParent(toast)
            .addClass("rapid-loading");

        rapid.getView().createdView("div", text).setParent(toast)
            .addClass("rapid-toast-content");

        for (let i = 0; i <= 11; i++) animation.addView(rapid.getView()
            .createdView("div").addClass("rapid-loading-leaf")
            .addClass("rapid-loading-leaf-" + i));

        !isTouch ? loading.setAttr("class",
            loading.getAttr("class") + " rapid-mask-transparent") : null;

        return loading.tapMove(function (event) {
            event.preventDefault();
        });
    };

    /**
     * 读取image到base64
     * @param fileView
     * @param call
     */
    BaseController.prototype.readImageToBase64 = function (fileView, call) {
        if (!fileView.files) return false;

        if (!fileView.files[0]) return rapid.getBuild().callback(call, '');

        const reader = new FileReader();

        reader.onload = function (e) {
            rapid.getBuild().callback(call, e.target.result);
        };

        reader.readAsDataURL(fileView.files[0]);
    };

    /**
     * sendHttpRequestToJson
     * @param url
     * @param data
     * @param call
     * @param method
     */
    BaseController.prototype.sendHttpRequestToJson = function (url, data, call, method) {

        method = method || 'post';

        rapid.getBuild().getHttpResponse(url, data)[method](function (textBody) {

            const data = textBody.toJSON();

            if (typeof call === 'function') call(data.code || 0, data.data || {}, data.msg || 'error!', data);

        }.bind(this));
    };

    /**
     * 发送统一 api
     * @param path
     * @param data
     * @param call
     * @param method
     * @param pathFirst
     */
    BaseController.prototype.sendUnifiedApi = function (path, data, call, method, pathFirst) {
        if (typeof pathFirst !== 'string' || !pathFirst) pathFirst = 'account/';

        const url = this.config.host.admin + pathFirst + path;

        this.sendHttpRequestToJson(url, data, function (code, data, msg) {

            if (call) return rapid.getBuild().callback(call, code, data, msg);

            if (code === 1) return window.history.go(0);

            alert(msg);

        }.bind(this), method);
    };

    /**
     * 获取地区列表
     * @param areaId
     * @param call
     */
    BaseController.prototype.getAreaList = function (areaId, call) {
        this.sendUnifiedApi("area/list?areaId=" + areaId, null, function (code, data) {
            if (code !== 1) if (typeof call === 'function') call([]);

            if (typeof call === 'function') call(data);
        }, 'get', '/');
    };

    /**
     * 国家更改
     * @param countryView
     * @param provinceView
     * @param cityView
     */
    BaseController.prototype.countryChange = function (countryView, provinceView, cityView) {

        provinceView.empty();

        const areaId = countryView.getValue();

        this.getAreaList(areaId, function (list) {

            rapid.getBuild().each(list, function (index, info) {

                provinceView.createdView("option", info.id)
                    .setHtml(info.name);

                if (index >= (list.length - 1)) this.provinceChange(provinceView, cityView);
            }.bind(this));
        }.bind(this));
    };

    /**
     * 省更改
     * @param provinceView
     * @param cityView
     */
    BaseController.prototype.provinceChange = function (provinceView, cityView) {
        if (!cityView) return;

        cityView.empty();

        const areaId = provinceView.getValue();

        this.getAreaList(areaId, function (list) {

            rapid.getBuild().each(list, function (index, info) {

                cityView.createdView("option", info.id)
                    .setHtml(info.name);

            }.bind(this));
        }.bind(this));
    };

    /**
     * 删除
     * @param type
     * @param id
     */
    BaseController.prototype.del = function (type, id) {
        if (!confirm("确定删除?")) return false;

        this.sendUnifiedApi(type + "/" + id + "/del");
    };

    /**
     * 上传文件
     * @param formView
     * @param call
     */
    BaseController.prototype.uploadFile = function (formView, call) {
        const box = this.loadingToast("上传中");

        const url = this.config.host.file + "file/upload";

        if (!(formView instanceof FormData)) {
            formView = new FormData(formView);
        }

        this.sendHttpRequestToJson(url, formView, function (code, data, msg) {
            box.remove();

            if (code !== 1) return alert(msg);

            rapid.getBuild().callback(call, data);

        }.bind(this), 'post');
    };

    /**
     * summernote 上传图片
     * @param summernote
     * @param files
     */
    BaseController.prototype.summernoteUploadImage = function (summernote, files) {
        rapid.getBuild().each(files, function (index, file) {

            const data = new FormData();

            data.append('file', file);

            this.uploadFile(data, function (data) {

                summernote.summernote('insertImage', data.url);
            }.bind(this));

        }.bind(this));
    };

    /**
     * 选择图片
     * @param e
     * @param view
     */
    BaseController.prototype.selectImgClick = function (e, view) {
        this.formView.createdView("input")
            .attr("name", "file")
            .attr("type", "file")
            .attr("accept", "image/*")
            .on("change", function () {
                BC.uploadFile(this.formView.getView(), function (data) {
                    view.data('rapid-form-value', data.file_id)
                        .getParent().data('fileId', data.file_id);

                    view.empty().createdView('img', data.url)
                        .addClass('rapid-width-full');
                });
            }.bind(this)).click();
    };

    /**
     * 预览图片
     * @param event
     * @param img
     */
    BaseController.prototype.previewImage = function (event, img) {
        const view = rapid.getView(this.view)
            .createdView('div')
            .css({
                width: '100%',
                height: '100%',
                display: 'flex',
                'justify-content': 'center',
                'align-items': 'center',
                background: 'rgba(0,0,0,0.23)',
                position: 'fixed',
                top: 0,
                left: 0
            })
            .click(function () {
                view.remove();
            });

        view.createdView('img')
            .css({
                maxWidth: '80%',
                maxHeight: '80%',
            })
            .attr('src', img.attr('src'));
    };

    /**
     * 对页面重新排序
     * @param data
     * @param event
     * @param view
     */
    BaseController.prototype.pageToSort = function (data, event, view) {

        this.loadingToast('加载中');

        if (typeof data === 'string') data = JSON.parse(decodeURIComponent(data));

        const orderName = view.data('order-name');

        const orderType = view.getParent().data('order-type') === 'DESC' ? 'ASC' : 'DESC';

        const page = view.getParent().data('page');

        data = Object.assign(data, {
            page: page,
            order_name: orderName,
            order_type: orderType
        });

        const urlParam = rapid.getBuild().toUrlQuery(data, true);

        window.location.href = window.location.href.replace(/\?.*/gi, '') + '?' + urlParam;
    };


    return BaseController;
})(Controller);
