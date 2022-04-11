const ListController = (function (controller) {

    rapid.__extends(ListController, controller);

    function ListController() {
        controller.apply(this, arguments);
    }

    /**
     * onCreate
     */
    ListController.prototype.onCreate = function () {
        BC.create();
    };

    /**
     * 添加或者修改栏目
     * @param data
     */
    ListController.prototype.added = function (data) {

        BC.sendUnifiedApi("cms/column/added", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            window.history.go(0);
        });
    };

    return ListController;
})(BaseController);
