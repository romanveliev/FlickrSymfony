define(['underscore', 'jquery'], function (_, $) {
    function Header(){
    }

    Header.prototype = {
        setHeader: function (data) {
            $('#header').css('display','none').empty().append(data).fadeIn(1000);
        }
    };

    return Header;
});


