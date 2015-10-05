define(['underscore', 'jquery'], function (_, $) {
    function Flickr(){
    }

    Flickr.prototype = {
        viewPhoto: function () {
//            $('#loadNone').attr('id','loadActive');
//            $(window).load(function() {
//                $('#loadActive').attr('id','loadNone');
//            });

            $('.click').click(function(){
                console.log('click photo flickr');
                $('#loadNone').attr('id','loadActive');
                var img = $(this).find('img').attr('foo');
                $('#big').attr('src',img);
                $('#big').load(function() {
                    $('#bigPhoto').
                    $('#big').animate({'left':'0%'},800);
                    $('body').css('background-image', 'url('+img+')');
                    $('#loadActive').attr('id','loadNone');
                });
            });

            setTimeout(function(){
                $('#big').click(function(){
                    $('#big').animate({'left':'100%'},1000);
                })
            }, 400)
        }
    };

    return Flickr;
});


