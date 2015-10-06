define(['underscore', 'jquery'], function (_, $) {
    function Mars(){
    }

    Mars.prototype = {
        ajaxSend: '',
        move: function () {
            $('[role=submit]').click(function(e){
                e.preventDefault();
                console.log('submit mars');
                var instructions = [], i = 0;
                $('[name=form] :input:not([type=submit])').not('[type=hidden]').each(
                    function(){
                        instructions[i] = $(this).val();i++;
                    });

                $.ajax({
                    url: '/mars_move',
                    type: 'post',
                    data: {'instructions': JSON.stringify(instructions)},
                    dataType: 'json',
                    success: function (data) {
                        if((typeof data) == 'string'){
                            $('#error_box').attr('class', 'alert alert-danger').css('display','block');
                            $('#errorFeedback').text('').append(data);
                        }
                        if((typeof data) == "object"){
                            $('#error_box').attr('class', 'alert alert-danger').css('display','none');
                            $('.mars_coordinates').append(data.html);
                        }
                    }
                })//ajax
            })
        }
    };

    return Mars;
});
