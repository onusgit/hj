<?php
/**
 * Template Name: Register
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.2
 */
// set a redirect for after logging in
//if (isset($_REQUEST['redirect_to'])) {
//    $redirect = $_REQUEST['redirect_to'];
//}
//if (!isset($redirect)) {
//    $redirect = home_url();
//}

$show_password_fields = apply_filters('show_password_fields_on_registration', true);
?>

<div class="content">

    <div class="content_botbg">

        <div class="content_reg">

            <!-- full block -->
            <div class="shadowblock_out">

                <div class="shadowblock">

                    <h2 class="col-md-12"><span class="colour"><?php _e('Register', APP_TD); ?></span></h2>

                    <?php do_action('appthemes_notices'); ?>

                                        <!--<p><?php _e('Complete the fields below to create your free account. Your login details will be emailed to you for confirmation so make sure to use a valid email address. Once registration is complete, you will be able to submit your ads.', APP_TD); ?></p>-->

                    <div class="register-box">

                        <?php if (get_option('users_can_register')) : ?>

                            <form action="<?php echo appthemes_get_registration_url('login_post'); ?>" method="post" class="loginform" name="registerform" id="registerform">

                                <div class="col-md-12">
                                    <label for="user_login"><?php _e('Username:', APP_TD); ?></label>
                                    <input tabindex="1" type="text" class="text required col-md-12" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" />
                                </div>

                                <div class="col-md-12">
                                    <label for="user_email"><?php _e('Email:', APP_TD); ?></label>
                                    <input tabindex="2" type="text" class="text required email col-md-12" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" />
                                </div>


                                <div class="col-md-12">
                                    <label for="pass1"><?php _e('Password:', APP_TD); ?></label>
                                    <input tabindex="3" type="password" class="text required col-md-12" name="pass1" id="pass3" value="" autocomplete="off" />
                                </div>

                                <div class="col-md-12">
                                    <label for="pass2"><?php _e('Password Again:', APP_TD); ?></label>
                                    <input tabindex="4" type="password" class="text required col-md-12" name="pass2" id="pass4" value="" autocomplete="off" />
                                </div>

                                <!--									<div class="strength-meter">
                                                                                                                <div id="pass-strength-result" class="hide-if-no-js"><?php _e('Strength indicator', APP_TD); ?></div>
                                                                                                                <span class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD); ?></span>
                                                                                                        </div>-->


                                <?php do_action('register_form'); ?>

                                <div class="col-md-12">

                                    <p class="submit">
                                            <!--<input tabindex="6" class="btn_orange" type="submit" name="register" id="register" value="<?php _e('Create Account', APP_TD); ?>" />-->
                                        <input type="submit" class="btn btn-success col-md-12" name="register" id="register" value="<?php _e('Create Account', APP_TD); ?>">
                                    </p>

                                </div>

                                <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect); ?>" />

                                <!-- autofocus the field -->
                                <script type="text/javascript">try {
                                        document.getElementById('user_login').focus();
                                    } catch (e) {
                                    }</script>

                            </form>

                        <?php else : ?>

                            <p><?php _e('** User registration is currently disabled. Please contact the site administrator. **', APP_TD); ?></p>

                        <?php endif; ?>

                    </div>

                    <div class="right-box">

                    </div><!-- /right-box -->

                    <div class="clr"></div>

                </div><!-- /shadowblock -->

            </div><!-- /shadowblock_out -->

        </div><!-- /content_res -->

    </div><!-- /content_botbg -->

</div><!-- /content -->
