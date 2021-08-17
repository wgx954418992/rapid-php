const ListController = (function (controller) {

    rapid.__extends(ListController, controller);

    function ListController() {
        controller.apply(this, arguments);
    }


    /**
     * 添加设置
     * @param data
     */
    ListController.prototype.added = function (data) {
        BC.sendUnifiedApi("system/setting/added", data, function (code, data, msg) {
            alert(msg);

            if (code === 1) return window.history.go(0);
        });
    };

    return ListController;
})(BaseController);