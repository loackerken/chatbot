(function () {
    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($('.message_template').clone().html());
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $('.messages').append($message);
                return setTimeout(function () {
                    return $message.addClass('appeared');
                }, 0);
            };
        }(this);
        return this;
    };
    $(function () {
        var getMessageText, message_side, sendMessage,sendMessageReply;
        getMessageText = function () {
            var $message_input;
            $message_input = $('.message_input');
            return $message_input.val();

        };
        sendMessage = function (text) {
            var $messages, message;
            if (text.trim() === '') {
                return;
            }
            $('.message_input').val('');
            $messages = $('.messages');
            message_side = 'right';
            message = new Message({
                text: text,
                message_side: message_side
            });
            message.draw();
            sendMessageReply(text);
            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
        };

        sendMessageReply = function (text) {
           setTimeout(function () {
            var $messages, message;
            var responseMsg;
            if (text.trim() === '') {
                return;
            }
            $messages = $('.messages');

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    responseMsg = this.responseText;
                    $('.message_input').val('');

                    message_side = 'left';
                    message = new Message({
                        text: responseMsg,
                        message_side: message_side
                    });6.0

                    message.draw();
                }else {
                  return;
                }
            };

            xmlhttp.open("GET", "./getChat.php?message=" + text, true);
            xmlhttp.send();

            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);

          }, 1000);
        };

        sendMessageHistory = function (text) {
            var $messages, message;
            if (text.trim() === '') {
                return;
            }
            $messages = $('.messages');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    responseMsg = this.responseText;
                    if(responseMsg.trim()!==''){
                    var messageRow,messageShow,messageAll = responseMsg.split('|');

                    for (i = 0; i < messageAll.length; i++) {
                      messageRow = messageAll[i].split('%');
                      if(messageRow[2].trim()==='BOT'){
                        message_side = 'left';
                      }else{
                        message_side = 'right';
                      }
                      messageShow = messageRow[0] + messageRow[1];
                      showHistory(messageShow,message_side);
                    }
                  }else{
                    return;
                  }
                }else {
                  return;
                }
            };

            xmlhttp.open("GET", "./selectAll.php", true);
            xmlhttp.send();

        };
        showHistory = function (text,side) {
            var $messages, message;
            
            $('.message_input').val('');
            $messages = $('.messages');
            message_side = side;
            message = new Message({
                text: text,
                message_side: message_side
            });
            message.draw();
            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
        };
        $('.send_message').click(function (e) {
            return sendMessage(getMessageText());
        });
        $('.message_input').keyup(function (e) {
            if (e.which === 13) {
                return sendMessage(getMessageText());
            }
        });
        sendMessageHistory('user_id');

    });


}.call(this));

$(document).ready(function(){ 
    $('#accordion').click(function(){ 
        $('.panel-collapse').toggleClass( 'collapse' );
        $('.chat_window').toggleClass( 'ht-500' );
        $('.tooltip_chat').addClass( 'collapse' );
    });
    $('.tooltiptext').click(function(){ 
        $('.tooltip_chat').addClass( 'collapse' );
    });
 
 
})




