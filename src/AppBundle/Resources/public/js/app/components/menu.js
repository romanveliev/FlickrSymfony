define(['underscore', 'jquery'], function (_, $) {
    function Menu(){
    }
    Menu.prototype = {
        render: function () {
            $.ajax({
                url: '/ajax',
                type: 'get',
                dataType: 'json',
                success: function (data) {

                    console.log(_.every(data));

                    if((typeof data) == "string" ) {
                        document.location.href = "/";
                    }
                    if((typeof data) == "object" && _.every(data)){
                        var list = $('<ul>');
                        $.each(data, function(index, value){
                            $('<li>').wrapInner(
                                $('<a>').attr({
                                    href:   index
                                }).attr('role', 'menu').text(value)).appendTo(list);
                        });
                        $('#menu').append(list).fadeIn(500);
                    }
                }
            });
        },
        selectpage: function(){

        }
    };

    return Menu;
});