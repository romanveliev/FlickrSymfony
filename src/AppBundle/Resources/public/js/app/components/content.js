define(['underscore', 'jquery'], function (_, $) {
    function Content(){
    }

    Content.prototype = {
        getContent: function (page) {
            if(page.length >0){
                $.ajax({
                    url: page,
                    type: 'get',
                    data: {'type': JSON.stringify('content')},
                    dataType: 'json',
                    success: function (data) {
                        if((typeof data) == "object"){
                            console.log(data);
                            var myform = data[0];
                            $('#content').css('display','none').empty().append(myform).fadeIn(1000);
                            $('#header').css('display','none').empty().append(data[1]).fadeIn(1000);
                        }
                    }
                });
            }else{
                console.log('net');
            }
        }
    };

    return Content;
});