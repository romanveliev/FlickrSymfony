define(['underscore', 'jquery'], function (_, $) {
    function Content(){
    }

    Content.prototype = {
        ajaxSend: '',
        getContent: function (page) {
            if(typeof page == "string"){
                $('#loadNone').attr('id','loadActive');
                this.ajaxSend = $.ajax({
                    url: page,
                    type: 'get',
                    data: {'type': JSON.stringify('content')},
                    dataType: 'json',
                    success: function (data) {
                        if((typeof data) == "object"){
                            var html = data.html;
                            $('#content').css('display','none').empty().append(html).fadeIn(1000);
                            $('#loadActive').attr('id','loadNone');// end user-friendly load
                            $(document).trigger('content.isReady', data.data.header);
                        }
                    }
                });
            }
        },
        getAjaxSend: function(){
            return this.ajaxSend;
        }
    };

    return Content;
});