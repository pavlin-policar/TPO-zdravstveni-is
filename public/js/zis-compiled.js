"use strict";

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Dashboard = function (_React$Component) {
    _inherits(Dashboard, _React$Component);

    function Dashboard() {
        _classCallCheck(this, Dashboard);

        return _possibleConstructorReturn(this, Object.getPrototypeOf(Dashboard).apply(this, arguments));
    }

    _createClass(Dashboard, [{
        key: "render",
        value: function render() {
            return React.createElement(
                "div",
                null,
                this.props.children
            );
        }
    }]);

    return Dashboard;
}(React.Component);

var Row = function Row(props) {
    return React.createElement(
        "div",
        { className: "row" },
        props.children
    );
};

var InlineDashboardComponent = function (_React$Component2) {
    _inherits(InlineDashboardComponent, _React$Component2);

    function InlineDashboardComponent() {
        _classCallCheck(this, InlineDashboardComponent);

        return _possibleConstructorReturn(this, Object.getPrototypeOf(InlineDashboardComponent).apply(this, arguments));
    }

    _createClass(InlineDashboardComponent, [{
        key: "render",
        value: function render() {}
    }]);

    return InlineDashboardComponent;
}(React.Component);

var DashboardComponent = function (_React$Component3) {
    _inherits(DashboardComponent, _React$Component3);

    function DashboardComponent() {
        _classCallCheck(this, DashboardComponent);

        return _possibleConstructorReturn(this, Object.getPrototypeOf(DashboardComponent).apply(this, arguments));
    }

    _createClass(DashboardComponent, [{
        key: "render",
        value: function render() {
            return React.createElement(
                "div",
                _extends({ className: "card card-no-padding" }, this.props),
                this.props.children
            );
        }
    }]);

    return DashboardComponent;
}(React.Component);

var Title = function Title(props) {
    return React.createElement(
        "div",
        { className: "card-header" },
        React.createElement(
            "div",
            { className: "card-title" },
            React.createElement(
                "div",
                _extends({ className: "title" }, undefined.props),
                props.children
            )
        ),
        React.createElement("div", { "class": "fa fa-compress icon-arrow-right", id: "glyphicon-user" })
    );
};

var Body = function Body(props) {
    return React.createElement(
        "div",
        _extends({ className: "card-body no-padding" }, undefined.props),
        props.children
    );
};

//# sourceMappingURL=zis-compiled.js.map