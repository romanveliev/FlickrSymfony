define(['jquery', './components/menu'], function ($, Menu) {
    function Mediator(){
    }
    var page ='';

    Mediator.prototype = {
        menu: new Menu,
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
                                    console.log(data[0]);
                                    var myform = data[0];

                                    $('#content').empty().append(myform).fadeIn(1000);
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