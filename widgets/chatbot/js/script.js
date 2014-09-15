(function() {

// Localize jQuery variable
    var jQuery;
    var chat;

    /******** Load jQuery if not present *********/
    if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
        var script_tag = document.createElement('script');
        script_tag.setAttribute("type","text/javascript");
        /*
        script_tag.setAttribute("src",
            "http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
            */
        script_tag.setAttribute("src",
            "wp-content/themes/stanleywp/js/jquery-1.9.1.min.js");
        if (script_tag.readyState) {
            script_tag.onreadystatechange = function () { // For old versions of IE
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                    scriptLoadHandler();
                }
            };
        } else { // Other browsers
            script_tag.onload = scriptLoadHandler;
        }
        // Try to find the head, otherwise default to the documentElement
        (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
    } else {
        // The jQuery version on the window is the one we want to use
        jQuery = window.jQuery;
        main();
    }

    /******** Called once jQuery has loaded ******/
    function scriptLoadHandler() {
        // Restore $ and window.jQuery to their previous values and store the
        // new jQuery in our local jQuery variable
        jQuery = window.jQuery.noConflict(true);
        // Call our main function
        main();
    }

    /******** Our main function ********/
    function main() {
        jQuery(document).ready(function($) {
            /******* Load CSS *******/
            var css_link = $("<link>", {
                rel: "stylesheet",
                type: "text/css",
                href: "widgets/chatbot/css/style.css"
            });
            css_link.appendTo('head');

            var ChatEngine=function(){
                var userName="You";
                var botName="Ryan";
                var msg="";
                var chatZone;

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
                    chatZone = jQuery("#chatZone");
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
                            //chatZone.append('<div class="chatmsg"><strong>'+botName+'</strong>: '+b+'<br/></div>');
                            reply.replaceWith('<div class="chatmsg"><strong>'+botName+'</strong>: '+b+'<br/></div>');
                            chatZone.animate({scrollTop: chatZone.prop("scrollHeight")}, 500);


                        }, 'json').fail(function(xhr, textStatus, errorThrown){
                                jQuery('#urlwarning').html("Something went wrong! Error = " + errorThrown);
                            });
                        chatZone.animate({scrollTop: chatZone.prop("scrollHeight")}, 500);
                    }
                    return false;
                };

                this.showWindow=function() {
                    jQuery('#chatWindow').animate({'right':'0'});
                    jQuery('#chatWindow #say').focus();
                }

                this.hideWindow=function() {
                    jQuery('#chatWindow').animate({'right':'-290px'});
                }
            }; // Chat Engine
            window.chat = new ChatEngine();

            /******* Load HTML *******/
            //var jsonp_url = "http://chatbot.com.au/widgets/chatbot/data.php";
            var jsonp_url = "widgets/chatbot/data.php";

            $.getJSON(jsonp_url, function(data) {
                $('#chatbot-container').html(data.html);
            });
        });
    } //main
})(); // We call our anonymous function immediately