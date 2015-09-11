define(['jquery'],function ($) {
    return $.ajax({
        url: '/app_dev.php/ajax',
        type: 'get',
        dataType:'json',
        success:function(data){
            console.log(data);
            alert(data)
            $('#menu').append(data);
        }
    });
});