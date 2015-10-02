define(['underscore', 'jquery'], function (_, $) {
    function Header(){
    }

    Header.prototype = {
        getHeader: function (page) {
            if(page.length >0){
                console.log(page);
                $.ajax({
                    url: page,
                    type: 'get',
                    data: {'type': JSON.stringify('header')},
                    dataType: 'json',
                    success: function (data) {
                        if((typeof data) == "string" ) {

                        }
                        if((typeof data) == "object"){
                            var myform = data[0];

                            $('#header').css('display','none').empty().append(myform).fadeIn(1000);
                        }
                    }
                });
            }else{
                console.log('net');
            }
        }
    };

    return Header;
});