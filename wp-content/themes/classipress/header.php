<?php
/**
 * Generic Header template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */
global $cp_options;
?>
<div class="header">
<!--    <div class="header_top">
        <div class="header_top_res">
            <p>
                <?php echo cp_login_head(); ?>
                <a href="<?php echo appthemes_get_feed_url(); ?>" class="srvicon rss-icon" target="_blank" title="<?php _e('RSS Feed', APP_TD); ?>"><?php _e('RSS Feed', APP_TD); ?></a>
                <?php if ($cp_options->facebook_id) { ?>
                    &nbsp;|&nbsp;<a href="<?php echo appthemes_make_fb_profile_url($cp_options->facebook_id); ?>" class="srvicon facebook-icon" target="_blank" title="<?php _e('Facebook', APP_TD); ?>"><?php _e('Facebook', APP_TD); ?></a>
                <?php } ?>

                <?php if ($cp_options->twitter_username) { ?>
                    &nbsp;|&nbsp;<a href="http://twitter.com/<?php echo $cp_options->twitter_username; ?>" class="srvicon twitter-icon" target="_blank" title="<?php _e('Twitter', APP_TD); ?>"><?php _e('Twitter', APP_TD); ?></a>
                <?php } ?>
            </p>
        </div> 
    </div> -->
    <div class="header_main">
        <div class="headmenu hidden-xs">
            <a href="/"> الرئيسية</a>
            <a href="/"> حراج السيارات</a>
            <a href="/"> أجهزة</a>
            <a href="/"> عقارات</a>
            <a href="/"> مواشي و حيوانات و طيور</a>
            <a href="/"> خدمات</a>
            <a href="/"> المزيد</a>
            <a href="/"> البحث</a>
        </div>
        <?php //wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'menu-header', 'fallback_cb' => false, 'container' => false)); ?>

    </div><!-- /header_main -->
    <div class="header_menu">
        <div class="">
            <?php //wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'menu-header', 'fallback_cb' => false, 'container' => false)); ?>
            <!--<a href="<?php echo CP_ADD_NEW_URL; ?>" class="obtn btn_orange"><?php _e('Post an Ad', APP_TD); ?></a>-->
            <!--<div class="clr"></div>-->

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="navbar-text navbar-right visible-xs ">
                <a href="https://haraj.com.sa/login.php" class="pull-left visible-xs ">دخول  </a>
                <a href="https://haraj.com.sa/advsearch.php" class="pull-left visible-xs "><i class="fa fa-search"></i></a>
            </p>
            <div class="collapse navbar-collapse navbar-ex1-collapse col-md-9">
                <ul class="nav navbar-nav menu">
                    <li><a href="login.php">تسجيل الدخول  </a></li>
                    <li><a href="register.php"> التسجيل بالموقع</a></li>
                    <li class=" "><a href="commission.php">حساب عمولة الموقع</a></li>
                    <li class="divider visible-xs"></li>
                    <li class="visible-xs"><a href="#"> حراج السيارات</a></li>
                    <li class="visible-xs"><a href="#"> أجهزة</a></li>
                    <li class="visible-xs"><a href="#"> عقارات</a></li>
                    <li class="visible-xs"> <a href=""> مواشي و حيوانات و طيور</a></li>
                    <li class="visible-xs"> <a href=""> خدمات</a></li>
                    <li class="visible-xs"> <a href="/sitemap.php"> المزيد</a></li>
                    <li class="visible-xs"><a href="/advsearch.php"> البحث</a></li>
                    <li class="visible-xs"><a href="/contact.php">اتصل بنا</a></li>
                    <li class="dropdown hidden-xs">
                        <a data-toggle="dropdown" class="dropdown" href="#"> <i class="fa fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="/advsearch.php"> البحث المتقدم</a></li>
                            <li><a href="/commission.php">حساب عمولة الموقع</a></li>
                            <li><a href="/contact.php">اتصل بنا</a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="logo">
                <?php if (get_header_image()) { ?>
                    <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php header_image(); ?>" class="header-logo" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
                    </a>
                <?php } elseif (display_header_text()) { ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php } ?>
                <?php if (display_header_text()) { ?>
                    <!--<div class="description"><?php bloginfo('description'); ?></div>-->
                <?php } ?>
            </div><!-- /logo -->
        </div><!-- /header_menu_res -->
    </div><!-- /header_menu -->
</div><!-- /header -->
