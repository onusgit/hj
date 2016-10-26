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
    <div class="header_main">
        <div class="headmenu hidden-xs">
            <a href="<?php echo site_url(); ?>"> الرئيسية</a>
            <a href="<?php echo site_url(); ?>/ad-category/حراج-السيارات"> حراج السيارات</a>
            <a href="<?php echo site_url(); ?>/ad-category/أجهزة"> أجهزة</a>
            <a href="<?php echo site_url(); ?>/ad-category/عقارات"> عقارات</a>
            <a href="<?php echo site_url(); ?>/ad-category/مواشي-و-حيوانات-و-طيور"> مواشي و حيوانات و طيور</a>
            <a href="<?php echo site_url(); ?>/ad-category/services"> خدمات</a>
            <a href="<?php echo site_url(); ?>/sitmap/"> المزيد</a>
            <a href="<?php echo site_url(); ?>/search"> البحث</a>
        </div>
        <?php //wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'menu-header', 'fallback_cb' => false, 'container' => false)); ?>

    </div><!-- /header_main -->
    <div class="header_menu">
        <div class="content-center">
            <?php //wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'menu-header', 'fallback_cb' => false, 'container' => false)); ?>
            <!--<a href="<?php echo CP_ADD_NEW_URL; ?>" class="obtn btn_orange"><?php _e('Post an Ad', APP_TD); ?></a>-->
            <!--<div class="clr"></div>-->

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="navbar-text navbar-right visible-xs ">
                <a href="<?php echo site_url(); ?>/login" class="pull-left visible-xs ">دخول  </a>
                <a href="<?php echo site_url(); ?>/advsearch" class="pull-left visible-xs "><i class="fa fa-search"></i></a>
            </p>
            <div class="collapse navbar-collapse navbar-ex1-collapse col-md-9">
                <ul class="nav navbar-nav menu">
                    <?php if(is_user_logged_in()):?>
                        <li><a href="<?php echo site_url(); ?>/dashboard/">Dashboard</a></li>                        
                    <?php else:?>
                    <li><a href="<?php echo site_url(); ?>/login">تسجيل الدخول  </a></li>
                    <li><a href="<?php echo site_url(); ?>/register"> التسجيل بالموقع</a></li>
                    <?php endif;?>
                    <li class=" "><a href="<?php echo site_url(); ?>/commission">حساب عمولة الموقع</a></li>
                    <li class="divider visible-xs"></li>
                    <li class="visible-xs"><a href="<?php echo site_url(); ?>"> حراج السيارات</a></li>
                    <li class="visible-xs"><a href="<?php echo site_url(); ?>"> أجهزة</a></li>
                    <li class="visible-xs"><a href="<?php echo site_url(); ?>"> عقارات</a></li>
                    <li class="visible-xs"> <a href="<?php echo site_url(); ?>"> مواشي و حيوانات و طيور</a></li>
                    <li class="visible-xs"> <a href="<?php echo site_url(); ?>"> خدمات</a></li>
                    <li class="visible-xs"> <a href="<?php echo site_url(); ?>/sitemap"> المزيد</a></li>
                    <li class="visible-xs"><a href="<?php echo site_url(); ?>/advsearch.php"> البحث</a></li>
                    <li class="visible-xs"><a href="<?php echo site_url(); ?>/contact">اتصل بنا</a></li>
                    <li class="dropdown hidden-xs">
                        <a data-toggle="dropdown" class="dropdown" href="#"> <i class="fa fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url(); ?>/advsearch"> البحث المتقدم</a></li>
                            <li><a href="<?php echo site_url(); ?>/commission">حساب عمولة الموقع</a></li>
                            <li><a href="<?php echo site_url(); ?>/contact">اتصل بنا</a></li>
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
