<?php

$validUrl = false;
if (isset($_GET["url"]))
    $url = htmlspecialchars($_GET["url"]);
    $validUrl = url_exists($url);

function url_exists($url) {
    $ch = @curl_init($url);
    @curl_setopt($ch, CURLOPT_HEADER, TRUE);
    @curl_setopt($ch, CURLOPT_NOBODY, TRUE);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $status = array();
    preg_match('/HTTP\/.* ([0-9]+) .*/', @curl_exec($ch) , $status);
    if (!empty($status)) {
        return ($status[1] == 200);
    }
    return false;
}
?>


<!DOCTYPE html>
<html>
<head>
    <script>
        function myFunction() {
            var person = prompt("Please enter your site, leave blank if you do not have", "http://");
            if (person != null) {
                document.getElementById("demo").innerHTML =
                        "Hello " + person + "! How are you today?";
            }
        }
    </script>
</head>
<body style="height:2000px; margin:0;padding: 0">
<script src='http://chatbot.com.au/widgets/chatbot/js/script.js' type='text/javascript'></script>
<div id='chatbot-container'></div>
<?php
    if ($validUrl) {
        echo "<iframe src='" . $url . "' frameborder='0' scrolling='no' style='width:100%;height:100%'/>";
    }
?>
</body>
</html>