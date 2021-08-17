const RouteController = (function (controller) {

    rapid.__extends(RouteController, controller);

    function RouteController() {
        controller.apply(this, arguments);
    }

    /**
     * onCreate
     */
    RouteController.prototype.onCreate = function () {
        this.create();

        $(".i-checks .role").on('ifClicked', function () {
            const view = $(this);

            const id = view.data('id');

            const pid = view.data('pid');

            const isCheck = view.is(':checked');

            $(".i-checks .role[data-pid='" + id + "']").iCheck(!isCheck ? 'check' : 'uncheck');

            const checkCount = $(".i-checks .role[data-pid='" + pid + "']:checked").length + (!isCheck ? 1 : -1);

            $(".i-checks .role[data-id='" + pid + "']").iCheck(checkCount >= 1 ? 'check' : 'uncheck');
        });
    }

    /**
     * 保存
     * @param data
     */
    RouteController.prototype.save = function (data) {
        const ids = [];

        $(".i-checks .role:checked").each(function () {
            ids.push($(this).data('id'));
        });

        BC.sendUnifiedApi("role/account/" + data.adminId + "/route/save", {ids: JSON.stringify(ids)}, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            if (code === 1) {
                alert('提交成功');

                window.history.go(0);
            }
        });
    };

    return RouteController;
})(BaseController);