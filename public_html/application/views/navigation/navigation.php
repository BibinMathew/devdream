<?php
$loggedIn = false;
$username = "";


if (isset($_SESSION['userData'])) {
    $loggedIn = true;
    $userData = $_SESSION['userData'];
    $username = $userData['first_name'];
}
?>
<div class="dreamnavigation">
    <nav class="clearfix">
        <ul class="clearfix">
            <li><a href="http://idreamias.com/">Home</a></li>
            <li><a href="http://idreamias.com/video/Videohome">Videos</a></li>
            <li><a href="http://idreamias.com/currentaff/Currhome">Current Affairs</a></li>
            <li><a href="http://idreamias.com/article/Articlehome">Articles</a></li>
            <li><a href="http://idreamias.com/download/DownloadHome">Downloads</a></li>
<?php
if ($loggedIn) {
    ?>     
                <li><a href="http://idreamias.com/">My Bookmarks </a></li>	
                <?php
            } else {
                ?>
                <li><a href="#loginModal" data-uk-modal>Login</a></li>	
                <?php
            }
            ?>
        </ul>
        <a href="#" id="pull">Menu</a>
    </nav>
</div>
<div id="loginModal" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
    <div class="uk-modal-dialog uk-modal-dialog-small">
        <button type="button" class="uk-modal-close uk-close"></button>

<?php
$attributes = array('class' => 'uk-panel uk-panel-box uk-form', 'id' => 'myform');
echo form_open('authentication/User_Authentication/customLogin');
?>
        <?php
        if (isset($error_message)) {
            echo '<div class="uk-alert uk-alert-danger text-center">' . $error_message . '</div>';
        }
        if (!empty(validation_errors()))
            echo '<div class="uk-alert uk-alert-danger text-center">' . validation_errors() . '</div>';
        ?>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="text"  name="email" placeholder="email">
        </div>
        <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="password" name="password" placeholder="password">
        </div>
        <div class="uk-form-row">
            <input type="submit"  value="Login" class="uk-width-1-1 uk-button uk-button-primary uk-button-large" name="submit" />
        </div>
        <div class="uk-form-row uk-text-small">
            <label class="uk-float-left"><input type="checkbox"> Remember Me</label>
            <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>
            <a class="uk-link uk-link-muted" style="margin-left:200px" href="<?php echo base_url() . 'authentication/CustomUser/register' ?>">Register</a>
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
        <button class="loginBtn loginBtn--facebook"> <a href='<?php echo $fauthUrl ?>'>Login with Facebook </a></button>
        <button class="loginBtn loginBtn--google"> <a href='<?php echo $authUrl ?>' >Login with Google </a></button>

<?php echo form_close(); ?>
    </div>
</div>