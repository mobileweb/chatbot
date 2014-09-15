var ChatEngine=function(){
    var userName="You";
    var botName="Ryan";
    var msg="";
    var chatZone=jQuery("#chatZone");

    this.showImg = function(input) {
        var regEx = /\[img\](.*?)\[\/img\]/;
        var repl = '<br><a href="$1" target="_blank"><img src="$1" alt="$1" width="150" /></a>';
        var out = input.replace(regEx, repl);
        console.log('out = ' + out);
        return out
    };

    this.makeLink=function(input) {
        var regEx = /\[link=(.*?)\](.*?)\[\/link\]/;
        var repl = '<a href="$1" target="_blank">$2</a>';
        var out = input.replace(regEx, repl);
        console.log('out = ' + out);
        return out;
    };

    //For sending message
    this.sendMsg=function(url){
        msg = jQuery('#say').val();
        var reply;

        if (msg.length > 0) {
            reply = jQuery('<div class="typing">Ryan is typing...</div>');

            chatZone.append('<div class="chatmsg"><b>'+userName+'</b>: '+msg+'<br/></div>');
            chatZone.append(reply);
            var formdata = jQuery("#talkform").serialize();
            jQuery('#say').val('')
            jQuery('#say').focus();
            jQuery.post(url, formdata, function(data){
                var b = data.botsay;
                if (b.indexOf('[img]') >= 0) {
                    b = showImg(b);
                }
                if (b.indexOf('[link') >= 0) {
                    b = makeLink(b);
                }
                reply.replaceWith('<div class="chatmsg"><strong>'+botName+'</strong>: '+b+'<br/></div>');
                //chatZone.append('<div class="chatmsg"><strong>'+botName+'</strong>: '+b+'<br/></div>');
                chatZone.animate({scrollTop: chatZone.prop("scrollHeight")}, 500);


            }, 'json').fail(function(xhr, textStatus, errorThrown){
                    jQuery('#urlwarning').html("Something went wrong! Error = " + errorThrown);
                });
            chatZone.animate({scrollTop: chatZone.prop("scrollHeight")}, 500);
        }
        return false;
    }
};

var chat= new ChatEngine();
