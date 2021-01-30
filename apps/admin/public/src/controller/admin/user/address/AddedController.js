const AddedController = (function (controller) {

    rapid.__extends(AddedController, controller);

    function AddedController() {
        controller.apply(this, arguments);
    }

    /**
     * onCreate
     */
    AddedController.prototype.onCreate = function () {
        this.create();
    };

    /**
     * countryView
     * @type {View}
     */
    AddedController.prototype.countryView = null;

    /**
     * provinceView
     * @type {View}
     */
    AddedController.prototype.provinceView = null;

    /**
     * 省被更改
     * @param event
     * @param view
     */
    AddedController.prototype.onCountryChange = function (event, view) {
        BC.countryChange(this.countryView, this.provinceView);
    };

    /**
     * 提交
     * @param data
     */
    AddedController.prototype.added = function (data) {
        BC.sendUnifiedApi('user/address/added', data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            window.location.href = rapid.getBuild().getHostUrl() + "admin/admin/user/address/added?id=" + data.address.id;
        });
    };


    return AddedController;
})(BaseController);