define(['jquery', './components/menu'], function ($, Menu) {
    function Mediator(){
    }
    Mediator.prototype = {
        menu: new Menu,
        renderMenu: function () {
            this.menu.render();
        }
    };

    return Mediator;
});