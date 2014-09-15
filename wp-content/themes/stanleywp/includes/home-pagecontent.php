<?php
/**
 * File used for homepage static page content module
 *
 * @package WordPress
 */
global $cookie_name;
  $cookie_name = 'Ryan_Chatbot';
  $botId = 1;
  $convo_id = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : jq_get_convo_id();
  $bot_id = (isset($_COOKIE['bot_id'])) ? $_COOKIE['bot_id'] :($botId !== false && $botId !== null) ? $botId : 1;
  setcookie('bot_id', $bot_id);
$url = constant('CHAT_URL');//'http://chatbot.com.au/chatbot/chatbot/conversation_start.php';


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
?>
  <!-- +++++ Welcome Section +++++ -->
  <div id="ww">
      <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 centered">
              <?php while( have_posts() ) : the_post(); ?>
                <?php if ( has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail(); ?>
                <?php endif; ?>
                <?php the_content(); ?>
                <?php endwhile; ?>
                <!--div class="user-logo">
                    <img src="wp-content/themes/stanleywp/images/user.png" alt=""/>
                </div-->

              <div class="chat">
                  <div id="chatZone" name="chatZone">
                      <div class="chatmsg greeting">
                      <strong>Ryan</strong>: Hello everybody. I’m Ryan, a virtual assistant developed by <a target="_blank" href="http://www.havitechnology.com"><strong>HAVI TECHNOLOGY</strong></a>.
                      WHAT CAN I HELP YOU WITH?
                          </div>
                  </div>
                  <form onsubmit="chat.sendMsg('<?php echo $url ?>'); return false;" name="talkform" id="talkform">
                      <input type="text" id="say" name="say" autofocus="true" placeholder="Type Your Meassage Here" />
                      <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
                      <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
                      <input type="hidden" name="format" id="format" value="json" />
                  </form>
              </div>
              </div><!-- /col-lg-8 -->
            </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /ww -->
<script type="text/javascript" src="wp-content/themes/stanleywp/js/chat.js"></script>



  
      
     