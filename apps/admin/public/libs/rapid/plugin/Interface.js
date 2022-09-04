rapid.Interface = (function () {


    function Interface(name) {
        this.interactName = name;
    }

    Interface.prototype.getInterface = function () {
        if (typeof window.parent === "object" && typeof window.parent[this.interactName] === "object") {
            return window.parent[this.interactName];
        } else {
            return "object" === typeof window[this.interactName] ? window[this.interactName] : "";
        }
    };

    Interface.prototype.isInteract = function (interfaceObject) {
        return "object" === typeof interfaceObject;
    };


    Interface.prototype.isIos = function () {
        return rapid.getBuild().getOS() === "Ios";
    };

    Interface.prototype.isPc = function () {
        return rapid.getBuild().getOS() === "Window";
    };

    Interface.prototype.exec = function (method, data, callback, interfaceObject, resultCall) {
        try {

            interfaceObject = interfaceObject || this.getInterface();

            if (!this.isInteract(interfaceObject)) return typeof callback === 'function' ? callback(data) : null;

            var methodFunc = interfaceObject[method];

            if (typeof methodFunc !== 'function') return typeof callback === 'function' ? callback(data) : null;

            var dataAr = [];

            for (var i in data) dataAr.push(data[i]);

            if (this.isPc()) dataAr.push(resultCall);

            var result = methodFunc.apply(interfaceObject, dataAr);

            if (typeof resultCall === 'function') resultCall(result);

            return result;
        } catch (e) {
            return null;
        }
    };

    return Interface;
})();