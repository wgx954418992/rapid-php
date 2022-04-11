const IntegralController = (function (controller) {

    rapid.__extends(IntegralController, controller);

    function IntegralController() {
        controller.apply(this, arguments);
    }

    /**
     * 提交
     * @param data
     */
    IntegralController.prototype.added = function (data) {
        BC.sendUnifiedApi("user/integral/set", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            window.history.go(0);
        });
    };

    return IntegralController;
})(BaseController);