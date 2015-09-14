define(['jquery'],function ($) {
    function Menu(){
    }
    Menu.prototype = {
        render: function () {
            $.ajax({
                url: '/ajax',
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    if((typeof data) == "string") {
                        document.location.href = "/";
                    }

                    if((typeof data) == "object"){
                        var text = '';
                        $.each(data, function(index, value){
                            text += "<a href='"+index+"'>"+value+" </a>";
                        });

                        $('#menu').append(text);
                    }
                }
            });
        },
    };

    return Menu;
});