require(['jquery','app/components/menu','app/components/content','app/components/header'],
    function ( $, Menu, Content, Header) {
        var page,
            menu = new Menu,
            content = new Content,
            header = new Header;

            menu.render();
            menu.getPage();

            $(document).on('menu.page', function(e, page){

                content.getContent(page);
//                header.getHeader(page);

            })

});