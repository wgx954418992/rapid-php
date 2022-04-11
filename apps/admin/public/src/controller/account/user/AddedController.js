const AddedController = (function (controller) {

    rapid.__extends(AddedController, controller);

    function AddedController() {
        controller.apply(this, arguments);
    }

    /**
     * 提交
     * @param data
     */
    AddedController.prototype.added = function (data) {
        BC.sendUnifiedApi("user/added", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            window.location.href = rapid.getGlobalConfigPathDir() + 'account/user/added?id=' + data.id;
        });
    };

    return AddedController;
})(BaseController);