rapid.PassPayView = (function () {

    var self;

    function PassPayView(parent, call, count) {
        self = this;
        this.call = call;
        this.inputView = [];
        this.parent = parent;
        this.count = count || 6;
        this.createdPassView().createdInputView();
    }

    /**
     * 创建pass view
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.createdPassView = function () {
        this.passView = this.parent.createdView("div").addClass("rapid-pay-password-view");
        return this;
    };

    /**
     * 创建input view
     */
    PassPayView.prototype.createdInputView = function () {
        rapid.getBuild().each(this.count, function (i) {
            var view = self.passView.createdView("input").addClass("input");
            self.setViewAttr(view).setFocusListener(view, i).setBlurListener(view, i);
            self.setInputListener(view, i).setKeydownListener(view, i).inputView.push(view);
        });

        return this;
    };

    /**
     * 设置view attr
     * @param view
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setViewAttr = function (view) {
        view.setAttr({
            maxlength: 1, type: "password", readonly: 1, autocomplete: "off", name: "passpay"
        });
        return this;
    };

    /**
     * 设置监听 focus事件
     * @param view
     * @param i
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setFocusListener = function (view, i) {
        view.focus(function () {
            if (!view.attr("readonly")) {
                view.addClass("before");
                view.removeAttr("readonly");
                self.passView.addClass("before");
            }
        });
        return this;
    };

    /**
     * 设置监听 blur 事件
     * @param view
     * @param i
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setBlurListener = function (view, i) {
        view.blur(function () {
            view.removeClass("before");
            self.passView.removeClass("before");
        });
        return this;
    };

    /**
     * 设置监听 input 事件
     * @param view
     * @param i
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setInputListener = function (view, i) {
        view.on("input", function () {
            self.setCall(self.getInputPassword(), i);
            if (i + 1 < self.count) self.setActive(i + 1);
        });
        return this;
    };

    /**
     * 设置监听 keydown 事件
     * @param view
     * @param i
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setKeydownListener = function (view, i) {
        view.on("keydown", function (event) {
            if (event.keyCode == 8 && !view.attr("readonly")) {
                if (this.value) {
                    this.value = "";
                } else {
                    if (i > 0) self.setActive(i - 1) && self.inputView[i - 1].setValue("");
                    window.event.returnValue = false;
                    self.setCall(self.getInputPassword(), i);
                }
            }
        });
        return this;
    };

    /**
     * 设置活动input View
     * @param index
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setActive = function (index) {
        rapid.getBuild().each(self.inputView, function (i, view) {
            if (i == index) {
                view.removeAttr("readonly").focus();
            } else {
                view.attr("readonly", 1);
            }
        });
        return this;
    };

    /**
     * 回调
     * @param data
     * @param i
     * @returns {rapid.PassPayView}
     */
    PassPayView.prototype.setCall = function (data, i) {
        if (typeof self.call === 'function') self.call.apply(this, [data, i]);
        return this;
    };

    /**
     * 获取输入的密码
     * @returns {string}
     */
    PassPayView.prototype.getInputPassword = function () {
        var value = "";
        for (var i = 0; i < self.inputView.length; i++)value += self.inputView[i].getValue();
        return value;
    };


    return PassPayView;
})();