<?php

/* set out document type to text/javascript instead of text/html */
header("Content-type: text/javascript");
header("access-control-allow-origin: *");

global $cookie_name;
$cookie_name = 'Ryan_Chatbot';
$botId = 1;
$convo_id = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : jq_get_convo_id();
$bot_id = (isset($_COOKIE['bot_id'])) ? $_COOKIE['bot_id'] :($botId !== false && $botId !== null) ? $botId : 1;
setcookie('bot_id', $bot_id);
$url = 'http://chatbot.com.au/chatbot/chatbot/talk.php';

/**
 * Function jq_get_convo_id
 *
 *
 * @return string
 */
function jq_get_convo_id()
{
    global $cookie_name;
    session_name($cookie_name);
    session_start();
    $convo_id = session_id();
    session_destroy();
    setcookie($cookie_name, $convo_id);
    return $convo_id;
}

$html = "<div onclick=\"chat.showWindow()\" id=\"sidebar_image\" style=\"display: block;\">".
            "<a onclick=\"chat.showWindow()\" href=\"javascript:void(0)\">".
                "<img border=\"0\" src=\"http://chatbot.com.au/wp-content/themes/stanleywp/images/chat.png\">" .
            "</a></div>" .
        "<div id=\"chatWindow\">" .
            "<div id=\"chatHeader\">Ask Ryan, Your Virtual Assistant!</div>" .
            "<div id=\"chatZone\" name=\"chatZone\">" .
                "<div class=\"chatmsg greeting\">" .
                    "<strong>Ryan</strong>: Hello. May I help you?" .
            "</div></div>" .
            "<form onsubmit=\"chat.sendMsg('" . $url . "'); return false;\" name=\"talkform\" id=\"talkform\">" .
                "<ul id=\"chatform-fields\">" .
                    "<li><input type=\"text\" id=\"say\" name=\"say\" autofocus=\"true\" placeholder=\"Type Your Meassage Here\" /></li>" .
                "</ul>" .
                "<input type=\"hidden\" name=\"convo_id\" id=\"convo_id\" value=\"" . $convo_id . "/>" .
                "<input type=\"hidden\" name=\"bot_id\" id=\"bot_id\" value=\"" . $bot_id . "\" />" .
                "<input type=\"hidden\" name=\"format\" id=\"format\" value=\"json\" />" .
            "</form>" .
        "<div onclick=\"chat.hideWindow()\" title=\"Close\" style=\"background: url(&quot;http://dgjcoqnzn763b.cloudfront.net/images/merchant/swindow-sprite08.png&quot;) no-repeat scroll -5px 10px transparent; position: absolute; top: -20px; cursor: pointer; height: 40px; width: 30px; left:-10px;display: block;\" id=\"ssmi_getafan_sidebar_close_button\"></div>" .
        "</div>";
$arr = array(
        "html" => $html
    );

echo json_encode($arr);

?>