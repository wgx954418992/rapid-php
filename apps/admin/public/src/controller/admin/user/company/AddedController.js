const AddedController = (function (controller) {

    rapid.__extends(AddedController, controller);

    let formView;

    function AddedController() {
        controller.apply(this, arguments);
    }

    /**
     * onCreate
     */
    AddedController.prototype.onCreate = function () {
        this.create();

        formView = rapid.getView().createdView("form")
            .attr("method", "POST")
            .attr("enctype", "multipart/form-data");
    };

    /**
     * 选择图片
     * @param e
     * @param view
     */
    AddedController.prototype.selectImg = function (e, view) {
        formView.createdView("input")
            .attr("name", "file")
            .attr("type", "file")
            .attr("accept", "image/*")
            .on("change", function () {
                BC.uploadFile(formView.getView(), function (data) {
                    view.data('rapid-form-value', data.file_id)
                        .getParent().data('fileId', data.file_id);

                    view.empty().createdView('img', data.url)
                        .addClass('rapid-width-full');
                });
            }).click();
    };

    /**
     * 提交
     * @param data
     */
    AddedController.prototype.added = function (data) {
        BC.sendUnifiedApi("user/company/added", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            window.location.href = rapid.getGlobalConfigPathDir() + 'admin/user/company/added?userId=' + data.user.id;
        });
    };

    return AddedController;
})(BaseController);