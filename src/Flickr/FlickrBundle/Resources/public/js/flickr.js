$(document).ready(function(){

    $('#none').attr('id','active');
    $(window).load(function() {
        $('#active').attr('id','none');
    });

    $('.click').click(function(){
        $('#none').attr('id','active');
        var img = $(this).find('img').attr('foo');
        $('#big').attr('src',img);
        $('#big').load(function() {
            $('#big').animate({'left':'0%'},800);
            $('#active').attr('id','none');
        });
    });

   setTimeout(function(){
       $('#big').click(function(){
           $('#big').animate({'left':'100%'},1000);
       })
   }, 400)
});