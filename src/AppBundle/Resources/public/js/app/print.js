define(['jquery'],function ($) {
    return $.ajax({
        url: '{{ path("_ajax") }}ajax',
        type: 'get',
        dataType:'json',
        success:function(data){

            //alert(data);
            $('#menu').append(data);
        }
    });
});