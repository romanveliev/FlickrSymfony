define(['jquery', './components/menu', './components/content'], function ($, Menu, Content) {
    function Test(){
    }
    var page ='';


    Test.prototype = {
        menu: new Menu,
        content: new Content,
        renderMenu: function () {
            this.menu.render();
        },
        testMenu: function () {
            this.menu.getPage();
            $(document).on('menu.page', function(e, page){
                console.log(page);
            })
        }
    }

    return Test;
});