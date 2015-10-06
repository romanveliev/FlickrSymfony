define(['jquery', 'underscore', './components/menu', './components/content',
    './components/header', '././flickr', './mars/marsMain'],
    function ($, _, Menu, Content, Header, Flickr , Mars) {
        function Mediator(){
        }
        var page ='', menu= new Menu(),content = new Content, header = new Header, mars;

        Mediator.prototype = {
            renderPage: function(){
                menu.render();
                $('#menu').on('menu.isReady', function(){
                    page = menu.getPage();

                    $(document).on('menu.page', _.throttle(function(e, page){
                        var ajaxsend = content.getAjaxSend();
                        if(ajaxsend && ajaxsend.readyState != 4){
                            ajaxsend.abort();
                        }
                        content.getContent(page);
                        $(document).on('content.isReady', function(e, data){
                            header.setHeader(data);


                            mars = new Mars();
                            mars.move();


                            var flickr = new Flickr();
                            flickr.viewPhoto();
                        })

                    }, 2000))
                });
            }

        };

        return Mediator;
    });