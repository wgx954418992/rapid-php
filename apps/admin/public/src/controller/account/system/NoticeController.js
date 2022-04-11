const NoticeController = (function (controller) {

    rapid.__extends(NoticeController, controller);

    function NoticeController() {
        controller.apply(this, arguments);
    }

    /**
     * text content view
     * @type {null}
     */
    NoticeController.prototype.textContentView = null;

    /**
     * onCreate
     */
    NoticeController.prototype.onCreate = function () {
        BC.create();

        this.textContentView = BC.initSummernote();
    };

    /**
     * item 点击编辑
     * @param data
     */
    NoticeController.prototype.onItemAddedClick = function (data) {
        $("#modal").modal('show');

        data = rapid.getBuild().toJson(decodeURIComponent(data));

        for (const name in data) {
            if (!data.hasOwnProperty(name)) continue;

            if (name === 'content') {
                this.textContentView.summernote('code', data[name]);
            } else {
                $("#modal input[name=" + name + "]").val(data[name]);
            }
        }
    };

    /**
     * 添加或者修改
     * @param data
     */
    NoticeController.prototype.added = function (data) {
        data.content = encodeURIComponent(this.textContentView.summernote('code'));

        BC.sendUnifiedApi("system/notice/added", data, function (ret, data, msg) {
            alert(msg);

            if (ret === 1) return window.history.go(0);
        });
    };

    return NoticeController;
})(BaseController);