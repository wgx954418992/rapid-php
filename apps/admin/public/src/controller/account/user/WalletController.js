const WalletController = (function (controller) {

    rapid.__extends(WalletController, controller);

    function WalletController() {
        controller.apply(this, arguments);
    }

    /**
     * 提交
     * @param data
     */
    WalletController.prototype.added = function (data) {
        BC.sendUnifiedApi("user/wallet/set", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            window.history.go(0);
        });
    };

    return WalletController;
})(BaseController);
