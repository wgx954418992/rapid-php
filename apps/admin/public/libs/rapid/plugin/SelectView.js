rapid.SelectView = (function () {

    function SelectView(selectView) {
        this.eventChange = null;

        this.selectView = getSelectView(selectView);

        this.selectLayerView = getSelectLayerView(this.selectView);

        this.selectContentView = getSelectContentView(this.selectView);

        this.selectContentListView = getSelectContentListView(this.selectContentView);

        this.selectContentTitleView = getSelectContentTitleView(this.selectContentView);

        this.selectContentCheckView = getSelectContentCheckView(this.selectContentView);

        this.initSelectView();
    }

    /**
     * created selectView
     * @param name
     * @param value
     * @param attr
     */
    function createdView(name, value, attr) {
        return rapid.getView().createdView(name, value, attr);
    }

    /**
     * get selectView or created selectView
     * @param selectView
     * @returns {View}
     */
    function getSelectView(selectView) {
        return selectView !== null && selectView.isFrame() ? selectView : createdView("div").addClass("rapid-width-full").addClass("rapid-select");
    }

    /**
     * get layerView or created layerView
     * @param selectView
     * @returns {View|*}
     */
    function getSelectLayerView(selectView) {
        var layerView = selectView.find(".layer");

        return layerView.isFrame() ? layerView : selectView.createdView("div").addClass("layer");
    }

    /**
     * get contentView or created contentView
     * @param selectView
     * @returns {*}
     */
    function getSelectContentView(selectView) {
        var contentView = selectView.find(".content");

        return contentView.isFrame() ? contentView : selectView.createdView("div").addClass("content").addClass("rapid-width-full");
    }

    /**
     * get titleView or created titleView
     * @param contentView
     * @returns {*}
     */
    function getSelectContentTitleView(contentView) {
        var titleView = contentView.find(".title");

        return titleView.isFrame() ? titleView : contentView.createdView("div").data("selected", "1").addClass("title").addClass("option")
    }

    /**
     * get checkView or created checkView
     * @param contentView
     * @returns {View|*}
     */
    function getSelectContentCheckView(contentView) {
        var checkView = contentView.find(".check");

        if (!checkView.isFrame()) {
            checkView = contentView.createdView("div").addClass("check");

            checkView.createdView("span");
        }

        return checkView;
    }

    /**
     * get listView or created listView
     * @param contentView
     * @returns {View|*}
     */
    function getSelectContentListView(contentView) {
        var listView = contentView.find(".list");

        return listView.isFrame() ? listView : contentView.createdView("div").addClass("list");
    }

    /**
     * set titleView html and data-value
     * @param titleView
     * @param html
     * @param value
     */
    function setTitleValue(titleView, html, value) {
        titleView.setHtml(html).data("value", value);
    }

    /**
     * set current option selected
     * @param optionListView
     * @param view
     */
    function setOptionSelected(optionListView, view) {
        optionListView.each(function (view) {
            view.removeAttr("data-selected");
        }) && view.data("selected", "1");
    }

    /**
     * event call
     * @param call
     * @param self
     * @param argArray
     */
    function eventCall(call, self, argArray) {
        if (typeof call === 'function') call.apply(self, argArray);
    }

    /**
     * init SelectView and addEventListener
     */
    SelectView.prototype.initSelectView = function () {
        this.initSelectListView();

        this.selectLayerView.tap(this.hideListView.bind(this));

        this.selectContentTitleView.tap(this.toggleListView.bind(this));

        this.selectContentCheckView.tap(this.toggleListView.bind(this));

        this.getOptionViewList().eachOn("tap", this.onOptionViewClick.bind(this));
    };

    /**
     * init SelectView listView
     */
    SelectView.prototype.initSelectListView = function () {
        var optionViewList = this.getOptionViewList();

        var optionViewListLength = optionViewList.length();

        if (optionViewListLength > 0) {

            if (optionViewListLength > 1) {

                var optionSelectedView = this.selectContentView.find(".list>.option[data-selected='1']");

                optionSelectedView.isFrame() ? this.setValue(optionSelectedView) : this.setValue(optionViewList);
            } else {
                this.setValue(optionViewList);
            }
        }
    };

    /**
     * on OptionView click
     */
    SelectView.prototype.onOptionViewClick = function (view, event) {
        event.preventDefault();

        this.hideListView();

        this.setValue(view);

        return this;
    };

    /**
     * on option change
     */
    SelectView.prototype.onChange = function (call) {
        this.eventChange = call;

        return this;
    };

    /**
     * add optionView
     * @param title
     * @param value
     * @param attr
     * @returns {View|*}
     */
    SelectView.prototype.addOptionView = function (title, value, attr) {
        var optionView = this.selectContentListView.createdView("div", title).data("value", value || "").addClass("option").data(attr);

        if (parseInt(this.getOptionViewList().length()) === 1) this.setValue(optionView);

        optionView.tap(this.onOptionViewClick.bind(this, optionView));

        return optionView;
    };

    /**
     * remove All OptionView
     * @returns {rapid.SelectView}
     */
    SelectView.prototype.removeAllOptionView = function () {
        this.selectContentListView.empty();

        return this;
    };

    /**
     * get current option View
     * @returns {View}
     */
    SelectView.prototype.getOptionView = function () {
        return this.selectContentListView.find(".option[data-selected='1']");
    };

    /**
     * get optionViewList
     * @returns {View}
     */
    SelectView.prototype.getOptionViewList = function () {
        return this.selectContentListView.find(".option");
    };

    /**
     * show listView ,optionView
     * @returns {*}
     */
    SelectView.prototype.showListView = function () {
        this.selectLayerView.css("display", "block");

        this.selectContentListView.css("display", "block").data("show", "1");

        return this;
    };

    /**
     * hide listView ,optionView
     * @returns {*}
     */
    SelectView.prototype.hideListView = function () {
        this.selectLayerView.css("display", "none");

        this.selectContentListView.css("display", "none").data("show", "");

        return this;
    };

    /**
     * hide or show listView ,optionView
     */
    SelectView.prototype.toggleListView = function () {
        if (this.selectContentListView.data("show")) {
            this.hideListView();
        } else {
            this.showListView();
        }
    };


    /**
     * set current option view
     * @param optionView
     * @returns {*}
     */
    SelectView.prototype.setValue = function (optionView) {
        setOptionSelected(this.getOptionViewList(), optionView);

        setTitleValue(this.selectContentTitleView, optionView.getHtml(), optionView.data("value"));

        eventCall(this.eventChange, this, [optionView]);

        return this;
    };

    /**
     * get value
     * @returns {*}
     */
    SelectView.prototype.getValue = function () {
        var html = this.selectContentTitleView.getHtml();

        var value = this.selectContentTitleView.data("value");

        return value || html;
    };


    /**
     * get selectView
     * @returns {View|*}
     */
    SelectView.prototype.getSelectView = function () {
        return this.selectView;
    };

    return SelectView;
})();