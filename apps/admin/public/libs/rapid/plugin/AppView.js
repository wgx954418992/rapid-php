rapid.AppView = (function () {


    function AppView(interfaceApp) {
        this.interface = interfaceApp;
    }

    /**
     * viewController
     * @type {{}}
     */
    AppView.prototype.viewController = {};


    /**
     * createdView
     * @param src
     * @param parent
     */
    AppView.prototype.createdView = function (src, parent) {
        return rapid.getView().createdView('iframe', src, null, parent)
            .css("transform", "translate3d(0, 0, 0)")
            .css("webkitTransform", "translate3d(0, 0, 0)")
            .css("mozTransform", "translate3d(0, 0, 0)")
            .css("oTransform", "translate3d(0, 0, 0)")
            .css("msTransform", "translate3d(0, 0, 0)")
            .css('width', '100%').css('height', '100%')
            .css('position', 'absolute').css('display', 'none')
            .css("top", "0%").css("left", "-100%");

    };

    /**
     * setViewLoad
     * @param view
     * @param callback
     */
    function setViewLoad(view, callback) {
        var viewIFrame = null;

        view.on("load", function () {
            viewIFrame = view.getIFrame();

            if (typeof viewIFrame.getWindow().rapid !== 'function') return rapid.getBuild().callback(callback, viewIFrame);

            if (viewIFrame.getWindow().rapid.getGlobalConfigIsInit() !== false) return rapid.getBuild().callback(callback, viewIFrame);

            viewIFrame.getWindow().rapidInit = function () {

                rapid.getBuild().callback(callback, viewIFrame);

            }
        });
    }

    /**
     * getMainController
     * @param viewIFrame
     * @returns {*}
     */
    function getMainController(viewIFrame) {
        var controllers = Controller.getControllers(viewIFrame.getView());

        return Controller.getControllerMain(viewIFrame.getView(), controllers);
    }

    /**
     * created
     * @param data
     * @param parent
     * @param callback
     */
    AppView.prototype.created = function (data, parent, callback) {
        var views = {}, size = 0, view = null;

        var loadings = typeof data === 'string' ? [data] : data;

        rapid.getBuild().each(loadings, function (index, src) {
            views[src] = view = this.createdView(src, parent);

            setViewLoad(view, function (viewIFrame) {
                size++;

                view = rapid.getView(viewIFrame);

                var transition = ["transition", "webKitTransition", "mozTransition", "oTransition", "msTransition"];

                for (var i in transition) view.css(transition[i], "all 300ms");

                var mainController = getMainController(viewIFrame);

                this.addControllerView(mainController || src, views[src]);

                var controllerObject = viewIFrame.getWindow()[mainController];

                if (typeof controllerObject === 'object' && typeof controllerObject.onAppViewCreatedOver === 'function') controllerObject.onAppViewCreatedOver(view);

                if (size >= loadings.length) return rapid.getBuild().callback(callback, views);
            }.bind(this));
        }.bind(this));
    };

    /**
     * addControllerView
     * @param controller
     * @param view
     * @returns {rapid.AppView}
     */
    AppView.prototype.addControllerView = function (controller, view) {
        this.viewController[controller] = view;

        return this;
    };

    /**
     * getControllerView
     * @param controller
     * @returns {*}
     */
    AppView.prototype.getControllerView = function (controller) {
        return this.viewController[controller];
    };

    /**
     * switchs
     * @type {{}}
     */
    AppView.prototype.switchs = {};

    /**
     * switchsReverse
     * @type {{}}
     */
    AppView.prototype.switchsReverse = {};


    /**
     * addSwitchController
     * @param controller
     * @param currentController
     * @returns {rapid.AppView}
     */
    AppView.prototype.addSwitchController = function (controller, currentController) {
        this.switchs[controller] = currentController;

        this.switchsReverse[currentController] = controller;

        return this;
    };


    /**
     * index
     * @type {number}
     */
    AppView.prototype.index = 9999999;


    /**
     * show
     * @param currentController
     * @param controller
     * @param data
     * @returns {rapid.AppView}
     */
    AppView.prototype.show = function (currentController, controller, data) {
        var view = this.getControllerView(controller);

        if (!view) throw new Error(controller + ' controller does not exist');

        this.addSwitchController(controller, currentController);

        var window = view.getIFrame().getWindow();

        var showController = window[controller];

        if (typeof showController !== 'object') throw new Error('controller not initialized each other');

        view.setStyle('display', 'block').setStyle('z-index', this.index++);

        showController.onSwitchShow(this.animate(view));

        showController.onSwitchOver.apply(showController, [data || {}, currentController]);

        return this;
    };


    /**
     * hide
     * @param currentController
     * @param data
     * @returns {rapid.AppView.animate}
     */
    AppView.prototype.hide = function (currentController, data) {

        var controllerName = typeof currentController === 'object' ? currentController.constructor.name : currentController;

        var view = this.getControllerView(controllerName);

        if (!view) throw new Error(controllerName + ' controller does not exist');

        var showController = this.switchs[controllerName];

        currentController.onSwitchHide(this.animate(view));

        showController.onSwitchBack.apply(showController, [data || {}, currentController]);

        delete this.switchs[controllerName];
    };

    /**
     * animate
     * @type {Function}
     */
    AppView.prototype.animate = (function (view, closeFunc) {

        return function (style, time) {
            var transition = ["transition", "webKitTransition", "mozTransition", "oTransition", "msTransition"];

            for (var i in transition) view.css(transition[i], "all " + (time || 300) + "ms");

            view.focus().css(style);

            setTimeout(function () {

                if (typeof closeFunc === 'function') closeFunc();

                for (var i in transition) view.css(transition[i], "all 0ms");
            }, time);
        }
    });

    return AppView;
})();