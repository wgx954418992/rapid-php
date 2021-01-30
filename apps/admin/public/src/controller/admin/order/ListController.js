const ListController = (function (controller) {

    rapid.__extends(ListController, controller);

    function ListController() {
        controller.apply(this, arguments);
    }

    /**
     * onCreate
     */
    ListController.prototype.onCreate = function () {
        this.create();
    };

    /**
     * 点击设置订单
     * @param data
     */
    ListController.prototype.onSetOrderClick = function (data) {
        $('#modal').modal('show');

        $.each(data, function (name, item) {
            $('*[name=' + name + ']').val(item);
        });
    };

    /**
     * 设置订单信息
     * @param data
     */
    ListController.prototype.setOderInfo = function (data) {
        BC.sendUnifiedApi('order/set', data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('修改成功');

            window.history.go(0);
        });
    };


    return ListController;
})(BaseController);