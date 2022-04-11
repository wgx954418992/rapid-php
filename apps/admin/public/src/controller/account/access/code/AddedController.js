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
        BC.sendUnifiedApi("access/code/added", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            if (code === 1) {
                alert('提交成功');

                window.location.href = rapid.getGlobalConfigPathDir() + 'account/access/code/added?id=' + data.id;
            }
        });
    };

    return AddedController;
})(BaseController);