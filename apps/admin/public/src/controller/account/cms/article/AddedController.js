const AddedController = (function (controller) {

    rapid.__extends(AddedController, controller);

    function AddedController() {
        controller.apply(this, arguments);
    }


    /**
     * textContentView
     * @type {summernote}
     */
    AddedController.prototype.textContentView = null;

    /**
     * onCreate
     */
    AddedController.prototype.onCreate = function () {
        BC.create();

        this.textContentView = BC.initSummernote();
    };

    /**
     * 提交
     * @param data
     */
    AddedController.prototype.added = function (data) {
        delete data.files;

        data['content'] = encodeURIComponent(this.textContentView.summernote('code'));

        if (!data.content) return alert('请输入内容');

        BC.sendUnifiedApi("cms/article/added", data, function (code, data, msg) {
            if (code !== 1) return alert(msg);

            alert('提交成功');

            if (data.id){
                window.location.href = rapid.getGlobalConfigPathDir() + 'account/cms/article/added?id=' + data.id;
            }
        });
    };

    return AddedController;
})(BaseController);
