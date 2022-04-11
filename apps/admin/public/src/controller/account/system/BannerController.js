const BannerController = (function (controller) {

    rapid.__extends(BannerController, controller);

    function BannerController() {
        controller.apply(this, arguments);
    }

    /**
     * 添加或者修改
     * @param data
     */
    BannerController.prototype.added = function (data) {
        BC.sendUnifiedApi("system/banner/added", data, function (ret, data, msg) {
            alert(msg);

            if (ret === 1) return window.history.go(0);
        });
    };

    return BannerController;
})(BaseController);