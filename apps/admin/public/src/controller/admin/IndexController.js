const IndexController = (function (controller) {

    rapid.__extends(IndexController, controller);

    function IndexController() {
        controller.apply(this, arguments);
    }


    /**
     * cityView
     * @type {View}
     */
    IndexController.prototype.cityView = null;

    /**
     * areaView
     * @type {View}
     */
    IndexController.prototype.areaView = null;

    /**
     * onCreate
     */
    IndexController.prototype.onCreate = function () {
        this.create();
    };

    /**
     * 获取地区列表
     * @param areaId
     * @param call
     */
    IndexController.prototype.getAreaList = function (areaId, call) {
        BC.sendUnifiedApi("system/area/list?areaId=" + areaId, null, function (ret, data, msg) {
            if (ret !== 1) if (typeof call === 'function') call([]);

            if (typeof call === 'function') call(data);
        }, 'get');
    };

    /**
     * 省被更改
     * @param event
     * @param view
     */
    IndexController.prototype.onProvinceChange = function (event, view) {

        this.cityView.empty();

        this.areaView.empty();

        const areaId = view.getValue();

        this.getAreaList(areaId, function (list) {

            rapid.getBuild().each(list, function (index, info) {

                this.cityView.createdView("option", info.id)
                    .setHtml(info.aname);

                if (index >= (list.length - 1)) this.onCityChange(event, this.cityView);
            }.bind(this));
        }.bind(this));
    };

    /**
     * 城市更改
     * @param event
     * @param view
     */
    IndexController.prototype.onCityChange = function (event, view) {
        this.areaView.empty();

        const areaId = view.getValue();

        this.getAreaList(areaId, function (list) {

            rapid.getBuild().each(list, function (index, info) {

                this.areaView.createdView("option", info.id)
                    .setHtml(info.aname);

            }.bind(this));
        }.bind(this));
    };

    return IndexController;
})(BaseController);