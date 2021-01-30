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
        data.is_supreme = $("#is_supreme").is(':checked') ? 1 : 0;

        BC.sendUnifiedApi("role/account/added", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            if (code === 1) {
                alert('提交成功');

                window.location.href = rapid.getGlobalConfigPathDir() + 'admin/role/account/added?id=' + data.id;
            }
        });
    };

    return AddedController;
})(BaseController);