const ListController = (function (controller) {

    rapid.__extends(ListController, controller);

    function ListController() {
        controller.apply(this, arguments);
    }

    /**
     * 修改认证状态
     * @param certificatesId
     * @param event
     * @param view
     */
    ListController.prototype.onCertificatesStatusChange = function (certificatesId, event, view) {
        if (!confirm('确定修改状态吗')) return;

        BC.sendUnifiedApi("user/certificates/" + certificatesId + "/status/set", {status: view.getValue()}, function (code, data, msg) {
            alert(msg);

            if (code === 1) return window.history.go(0);
        });
    };

    return ListController;
})(BaseController);