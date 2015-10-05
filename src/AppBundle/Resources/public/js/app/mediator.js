define(['jquery', './components/menu', './components/content', './components/header', '././flickr'],
function ($, Menu, Content, Header, Flickr) {
        function Mediator(){
        }
        var page ='', menu= new Menu(),content = new Content, header = new Header;

        Mediator.prototype = {
            renderPage: function(){
                menu.render();
                $('#menu').on('menu.isReady', function(){
                    page = menu.getPage();

                    $(document).on('menu.page', function(e, page){
                        var ajaxsend = content.getAjaxSend();
                        if(ajaxsend && ajaxsend.readyState != 4){
                            ajaxsend.abort();
                        }
                        content.getContent(page);

                        $(document).on('content.isReady', function(e, data){
                            header.setHeader(data);

                            var flickr = new Flickr();
                            flickr.viewPhoto();
                        })

                    })
                });
            }

        };

        return Mediator;
    });