<?php
/**
 * Contact
 *
Template Name:  Demo Page
 *
 * @file           template-demo.php
 * @package        StanleyWP
 * @author         Vinh Vu
 */
?>

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
        if ($status[1] == 200 || $status[1] == 301) return true;
    }
    return false;
}
?>
    <script src='widgets/chatbot/js/script.js' type='text/javascript'></script>
    <div id='chatbot-container'></div>

<?php
    if ($validUrl) {
        echo "<iframe src='" . $url . "' frameborder='0' scrolling='yes' style='width:100%;height:100%'/>";
    } else {
        get_header();
?>
    <div id="ww">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 centered">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <header>
                                <h1><?php the_title(); ?></h1>
                            </header>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php
        get_footer();
    }
?>