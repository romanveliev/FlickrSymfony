require(['app/mediator', 'jquery', 'app/components/menu'],function (Mediator, $, menu) {


    var mediator = new Mediator;
        mediator.renderMenu();
        mediator.selectPage();


});