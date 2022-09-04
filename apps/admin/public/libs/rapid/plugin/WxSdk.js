rapid.WxSdk = (function () {

    let wxSdk,
        jsApiListConfig = ["checkJsApi", "onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo",
            "updateAppMessageShareData", "updateTimelineShareData", "hideMenuItems", "showMenuItems", "hideAllNonBaseMenuItem", "showAllNonBaseMenuItem", "translateVoice", "startRecord", "stopRecord", "onRecordEnd", "playVoice", "pauseVoice", "stopVoice", "uploadVoice", "downloadVoice", "chooseImage", "previewImage", "uploadImage", "downloadImage", "getNetworkType", "openLocation", "getLocation", "hideOptionMenu", "showOptionMenu", "closeWindow", "scanQRCode", "chooseWXPay", "openProductSpecificView", "addCard", "chooseCard", "openCard"];

    /**
     * WxSdk初始化
     * @param debug
     * @param callback
     * @param jsApiList
     * @constructor
     */
    function WxSdk(debug, callback, jsApiList) {
        wxSdk = this;

        this.setDebug(debug);

        this.setApiList(jsApiList);

        this.wxSdkConfig = rapid.getJavaScriptContentConfig(rapid.getGlobalConfig().dataNames.contentConfigWxSdk).toObject();

        this.setWxAppId(rapid.getBuild().getData(this.wxSdkConfig, 'appId'));

        this.setTimestamp(rapid.getBuild().getData(this.wxSdkConfig, 'timestamp'));

        this.setNonceStr(rapid.getBuild().getData(this.wxSdkConfig, 'nonceStr'));

        this.setSignature(rapid.getBuild().getData(this.wxSdkConfig, 'signature'));

        this.setSignature(rapid.getBuild().getData(this.wxSdkConfig, 'signature'));

        typeof callback === 'function' ? callback(this.wxSdkConfig) : null;

        this.setWxObject().setWxConfig(this.getWxSdkConfig());
    }


    /**
     * 获取wxSdkConfig
     * @returns {{debug, appId, timestamp, nonceStr, signature, jsApiList}}
     */
    WxSdk.prototype.getWxSdkConfig = function () {
        return {
            debug: this.getDebug(),
            appId: this.getWxAppId(),
            timestamp: this.getTimestamp(),
            nonceStr: this.getNonceStr(),
            signature: this.getSignature(),
            jsApiList: this.getApiList()
        };
    };

    /**
     * 设置wx对象
     * @returns {WxSdk}
     */
    WxSdk.prototype.setWxObject = function () {
        this.jweixin = typeof wx != 'object' ? function () {
            throw new Error('Please first introduce jweixin.js');
        }() : wx;
        return this;
    };

    /**
     * 设置wxConfig
     * @param config
     * @returns {WxSdk}
     */
    WxSdk.prototype.setWxConfig = function (config) {
        this.jweixin.config(config);
        return this;
    };

    /**
     * 设置debug
     * @param debug
     * @returns {WxSdk}
     */
    WxSdk.prototype.setDebug = function (debug) {
        this.debug = debug || false;
        return this;
    };

    /**
     * 获取debug
     * @returns {*|boolean}
     */
    WxSdk.prototype.getDebug = function () {
        return this.debug;
    };

    /**
     * 设置wxAppId
     * @param appId
     * @returns {WxSdk}
     */
    WxSdk.prototype.setWxAppId = function (appId) {
        this.appId = appId || null;
        return this;
    };

    /**
     * 获取wxAppId
     * @returns {*|null}
     */
    WxSdk.prototype.getWxAppId = function () {
        return this.appId;
    };

    /**
     * 设置timestamp
     * @param timestamp
     * @returns {WxSdk}
     */
    WxSdk.prototype.setTimestamp = function (timestamp) {
        this.timestamp = timestamp || null;
        return this;
    };

    /**
     * 获取timestamp
     * @returns {*|null}
     */
    WxSdk.prototype.getTimestamp = function () {
        return this.timestamp;
    };

    /**
     * 设置NonceStr
     * @param nonceStr
     * @returns {WxSdk}
     */
    WxSdk.prototype.setNonceStr = function (nonceStr) {
        this.nonceStr = nonceStr || null;
        return this;
    };

    /**
     * 获取NonceStr
     * @returns {*|null}
     */
    WxSdk.prototype.getNonceStr = function () {
        return this.nonceStr;
    };

    /**
     * 设置Signature
     * @param signature
     * @returns {WxSdk}
     */
    WxSdk.prototype.setSignature = function (signature) {
        this.signature = signature || null;
        return this;
    };

    /**
     * 获取Signature
     * @returns {*|null}
     */
    WxSdk.prototype.getSignature = function () {
        return this.signature;
    };

    /**
     * 设置ApiList
     * @param list
     * @returns {WxSdk}
     */
    WxSdk.prototype.setApiList = function (list) {
        this.jsApiList = list instanceof Array ? function () {
            const apiList = [];
            for (let i in list) if (jsApiListConfig.indexOf(list[i]) >= 0) apiList.push(list[i]);
            return apiList;
        }() : jsApiListConfig;
        return this;
    };

    /**
     * 获取ApiList
     * @returns {string[]|*}
     */
    WxSdk.prototype.getApiList = function () {
        return this.jsApiList;
    };

    /**
     * 设置WxSdk对象参数
     * @param name
     * @param value
     * @returns {WxSdk}
     */
    WxSdk.prototype.setWxSdk = function (name, value) {
        const callback = this.jweixin[name];

        typeof callback === 'function' ? this.jweixin[name](value) : null;

        return this;
    };

    /**
     * 设置分享到朋友圈
     * @param title
     * @param link
     * @param icon
     * @param success
     * @returns {WxSdk}
     */
    WxSdk.prototype.setWxShareTimeline = function (title, link, icon, success) {
        const value = {title: title, link: link, imgUrl: icon, success: success};

        return this.setWxSdk('updateTimelineShareData', value);
    };

    /**
     * 设置分享给朋友
     * @param title
     * @param desc
     * @param link
     * @param icon
     * @param success
     * @returns {WxSdk}
     */
    WxSdk.prototype.setWxShareAppMessage = function (title, desc, link, icon, success) {
        const value = {
            title: title,
            desc: desc,
            link: link,
            imgUrl: icon,
            success: success
        };
        return this.setWxSdk('updateAppMessageShareData', value);
    };

    /**
     * 选择图片
     * @param call
     * @param param
     * @param uploadComplete
     * @returns {WxSdk}
     */
    WxSdk.prototype.chooseImage = function (call, param, uploadComplete) {
        const _param = rapid.getBuild().extend({
            count: 1,
            sizeType: ['original', 'compressed'],
            sourceType: ['album', 'camera'],
        }, param);

        _param.success = function (res) {
            const localIds = res.localIds;

            rapid.getBuild().callback(call, localIds, res);

            if (typeof uploadComplete === "function") return wxSdk.uploadImage(localIds.toString(), uploadComplete, 1);
        };

        return this.setWxSdk('chooseImage', _param);
    };

    /**
     * 上传图片
     * @param localId 需要上传的图片的本地ID，由chooseImage接口获得
     * @param call
     * @param isShowProgressTips 默认为1，显示进度提示
     * @returns {WxSdk}
     */
    WxSdk.prototype.uploadImage = function (localId, call, isShowProgressTips) {
        isShowProgressTips = isShowProgressTips || 1;

        return this.setWxSdk('uploadImage', {
            localId: localId,
            isShowProgressTips: isShowProgressTips,
            complete: function (res) {

                rapid.getBuild().callback(call, res.serverId, res);
            }
        });
    };

    /**
     * 获取本地图片base64数据
     * @param localId
     * @param call
     * @returns {WxSdk}
     */
    WxSdk.prototype.getLocalImgData = function (localId, call) {
        return this.setWxSdk("getLocalImgData", {
            localId: localId,
            success: function (res) {

                rapid.getBuild().callback(call, res.localData, res);
            }
        });
    };

    /**
     * 包装微信录音程序
     * @type {RecordModule}
     */
    const RecordModule = (function () {

        let time = 0;

        let timer = 0;

        let recordModule = null;

        /**
         * 初始化
         * @constructor
         * @param param
         */
        function RecordModule(param) {
            recordModule = this;

            this.param = rapid.getBuild().extend(this.param, param);
        }

        /**
         * 参数
         * @type {{uploadComplete: null, maxTime: number, minTime: number, start: null, complete: null, isAutoUp: boolean}}
         */
        RecordModule.prototype.param = {
            /**
             * 录音最小时间
             */
            minTime: 5,
            /**
             * 录音最大时间
             */
            maxTime: 60,
            /**
             * 录音开始回调函数
             */
            start: null,
            /**
             * 录音完毕回调函数
             */
            complete: null,

            /**
             * 上传完成回调
             */
            uploadComplete: null,

            /**
             * 是否自动上传
             */
            isAutoUp: false,
        };

        /**
         * 语音文件Id
         * @type {string}
         */
        RecordModule.prototype.localId = '';

        /**
         * 开始录音
         */
        RecordModule.prototype.start = function () {
            time = 0;

            this.localId = '';

            this.runInterval();

            wxSdk.startRecord(function (res) {

                rapid.getBuild().callback(recordModule.param.start, res);
            }.bind(this));
        };

        /**
         * 停止录音
         * @param res 自动停止接口过来的
         * @returns {boolean}
         */
        RecordModule.prototype.stop = function (res) {
            function completeCall(res) {
                clearInterval(timer);

                recordModule.localId = res.localId;

                rapid.getBuild().callback(recordModule.param.complete, recordModule.localId, time, res);

                if (time < recordModule.param.minTime) return false;

                if (recordModule.param.isAutoUp === true) recordModule.uploadVoice();
            }

            if (typeof res === 'object' && res !== null) return completeCall(res);

            wxSdk.stopRecord(completeCall);
        };

        /**
         * 上传语音
         */
        RecordModule.prototype.uploadVoice = function () {
            if (!this.localId) throw new Error('localId is empty!');

            wxSdk.uploadVoice(this.localId, function (res) {
                clearInterval(timer);

                rapid.getBuild().callback(recordModule.param.uploadComplete, res.serverId, time, res);
            }.bind(this));
        };

        /**
         * 计时
         */
        RecordModule.prototype.runInterval = function () {
            wxSdk.setWxSdk('onVoiceRecordEnd', {
                complete: function (res) {
                    recordModule.stop(res) || clearInterval(timer);
                }
            });

            timer = setInterval(function () {
                if (time >= this.param.maxTime) this.stop() || clearInterval(timer);

                time++;
            }.bind(this), 1000);
        };

        return RecordModule;
    })();

    /**
     * 开始录音
     * @param call
     */
    WxSdk.prototype.startRecord = function (call) {
        return this.setWxSdk('startRecord', {complete: call});
    };

    /**
     * 停止录音
     * @param call
     * @returns {WxSdk}
     */
    WxSdk.prototype.stopRecord = function (call) {
        return this.setWxSdk('stopRecord', {success: call});
    };

    /**
     * 上传语音
     * @param localId
     * @param call
     * @returns {WxSdk}
     */
    WxSdk.prototype.uploadVoice = function (localId, call) {
        return this.setWxSdk('uploadVoice', {localId: localId, success: call});
    };

    /**
     * 播放本地录音接口
     * @param localId
     * @returns {WxSdk}
     */
    WxSdk.prototype.playVoice = function (localId) {
        return this.setWxSdk('playVoice', {localId: localId});
    };

    /**
     * 暂停播放本地录音接口
     * @param localId
     * @returns {WxSdk}
     */
    WxSdk.prototype.pauseVoice = function (localId) {
        return this.setWxSdk('pauseVoice', {localId: localId});
    };

    /**
     * 监听录音播放完毕
     * @param call
     * @returns {WxSdk}
     */
    WxSdk.prototype.onVoicePlayEnd = function (call) {
        return this.setWxSdk('onVoicePlayEnd', {success: call});
    };

    /**
     * 停止播放本地录音接口
     * @param localId
     * @returns {WxSdk}
     */
    WxSdk.prototype.stopVoice = function (localId) {
        return this.setWxSdk('stopVoice', {localId: localId});
    };

    /**
     * 下载语音接口
     * @returns {WxSdk}
     * @param serverId
     * @param isShow
     * @param call
     */
    WxSdk.prototype.downloadVoice = function (serverId, isShow, call) {
        return this.setWxSdk('downloadVoice', {serverId: serverId, isShowProgressTips: isShow, success: call});
    };

    /**
     * 识别音频并返回识别结果接口
     * @returns {WxSdk}
     * @param localId
     * @param isShow
     * @param call
     */
    WxSdk.prototype.translateVoice = function (localId, isShow, call) {
        return this.setWxSdk('downloadVoice', {localId: localId, isShowProgressTips: isShow, success: call});
    };

    /**
     * 获取微信录音集成程序
     * @returns {RecordModule}
     * @param param
     */
    WxSdk.prototype.getRecordModule = function (param) {
        return new RecordModule(param);
    };

    /**
     * 长按录音
     * @param recordModule
     * @param view
     * @param uploadComplete
     * @returns {WxSdk}
     */
    WxSdk.prototype.longTouchRecord = function (recordModule, view, uploadComplete) {

        if (typeof uploadComplete === 'function') recordModule.param.uploadComplete = uploadComplete;

        view.once('touchstart', function (e) {
            e.preventDefault();

            recordModule.start();
        }.bind(this));

        view.once('touchend', function () {

            recordModule.stop();
        }.bind(this));

        return this;
    };

    /**
     * 载入完毕回调事件
     * @param callback
     * @returns {WxSdk}
     */
    WxSdk.prototype.ready = function (callback) {
        this.jweixin.ready(function () {
            typeof callback === 'function' ? callback(wxSdk) : null;
        });
        return this;
    };

    return WxSdk;
})();