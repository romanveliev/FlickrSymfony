define(['jquery', './components/menu', './components/content'], function ($, Menu, Content) {
    function Mediator(){
    }
    var page ='';

    Mediator.prototype = {
        menu: new Menu,
        content: new Content,
        renderMenu: function () {
            this.menu.render();
        },
        selectPage: function(){
            setTimeout(function(){
                $('a[role=menu]').click(function(event){
                    event.preventDefault();
                    page = $(this).attr('href');
                    if(page.length >0){
                        console.log(page);
                        $.ajax({
                            url: page,
                            type: 'get',
                            dataType: 'json',
                            success: function (data) {
                                if((typeof data) == "string" ) {
                                }
                                if((typeof data) == "object"){
                                    console.log(data[0], data[1]);
                                    var myform = data[0];
                                    $('#content').css('display','none').empty().append(myform).fadeIn(1000);
                                }
                            }
                        });
                    }else{
                        console.log('net');
                    }
                })
            }, 500);
        }
    };

    return Mediator;
});