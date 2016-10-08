<?php
/**
 * The Template for displaying all single ads.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.0
 */
?>


<div class="content">

    <div class="content_botbg">

        <div class="content_ads">

            <!--<div id="breadcrumb"><?php // cp_breadcrumb();      ?></div>-->

            <div class="clr"></div>

            <div class="content_left_ads">

                <?php do_action('appthemes_notices'); ?>

                <?php appthemes_before_loop(); ?>

                <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php appthemes_before_post(); ?>

                        <?php appthemes_stats_update($post->ID); //records the page hit ?>

                        <div class="shadowblock_out <?php cp_display_style('featured'); ?>">

                            <div class="shadowblock">

                                <?php // appthemes_before_post_title(); ?>

                                                                        <!--<h1 class="single-listing"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php // the_title();      ?></a></h1>-->

                                <div class="clr"></div>

                                <?php // appthemes_after_post_title(); ?>

                                <!--<div class="pad5 dotted"></div>-->
                                <div class=" row ad_high margin-0">
                                    <h3 itemprop="name"><font><font> »Villa for sale in the western district of Riyadh, the breeze</font></font></h3>
                                    <div class=" comment_header">
                                        &nbsp; <a href="https://haraj.com.sa/users/qwqw0000" class="username"><font><font>qwqw0000</font></font></a><font><font>       &nbsp; minute before the </font></font><a href="https://haraj.com.sa/city/الرياض" class="city-head"><font><font>Riyadh</font></font></a>
                                        <br><font><font> 
                                        Listing ID: 16542717
                                        </font></font><div class="pull-left">



                                            <a href="https://haraj.com.sa/nextad.php?ads_id=16542717&amp;url=http://haraj.com/&amp;nextads=%D9%81%D9%8A%D9%84%D8%A7_%D9%84%D9%84%D8%A8%D9%8A%D8%B9_%D9%81%D9%8A_%D8%AD%D9%8A_%D8%A7%D9%84%D9%86%D8%B3%D9%8A%D9%85_%D8%A7%D9%84%D8%BA%D8%B1%D8%A8%D9%8A_%D9%81%D9%8A_%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6" class="nextad"><font><font> Next ←  </font></font></a>
                                            <br>
                                        </div>
                                    </div>

                                </div>
                                <div class="bigright padding-top-20 <?php // cp_display_style('ad_single_images');      ?>">

                                    <ul>

                                        <?php
                                        // grab the category id for the functions below
                                        $cat_id = appthemes_get_custom_taxonomy($post->ID, APP_TAX_CAT, 'term_id');

                                        if (get_post_meta($post->ID, 'cp_ad_sold', true) == 'yes') {
                                            ?>
                                            <li id="cp_sold"><span><?php _e('This item has been sold', APP_TD); ?></span></li>
                                            <?php
                                        }

                                        // 3.0+ display the custom fields instead (but not text areas)
                                        cp_get_ad_details($post->ID, $cat_id);
                                        ?>

                                        <li id="cp_listed"><span><?php _e('Listed:', APP_TD); ?></span> <?php echo appthemes_display_date($post->post_date); ?></li>
                                        <?php if ($expire_date = get_post_meta($post->ID, 'cp_sys_expire_date', true)) { ?>
                                            <li id="cp_expires"><span><?php _e('Expires:', APP_TD); ?></span> <?php echo cp_timeleft($expire_date); ?></li>
                                        <?php } ?>

                                    </ul>

                                </div><!-- /bigright -->


                                <?php if ($cp_options->ad_images) { ?>

                                    <div class="bigleft">

                                        <div id="main-pic">

                                            <?php cp_get_image_url(); ?>

                                            <div class="clr"></div>

                                        </div>

                                        <div id="thumbs-pic">

                                            <?php cp_get_image_url_single($post->ID, 'thumbnail', $post->post_title, -1); ?>

                                            <div class="clr"></div>

                                        </div>

                                    </div><!-- /bigleft -->

                                <?php } ?>

                                <div class="clr"></div>

                                <?php appthemes_before_post_content(); ?>

                                <div class="single-main">

                                    <?php
                                    // 3.0+ display text areas in content area before content.
                                    cp_get_ad_details($post->ID, $cat_id, 'content');
                                    ?>

                                                            <!--<h3 class="description-area"><?php _e('Description', APP_TD); ?></h3>-->


                                    <div class="contact padding-top-20">
                                        <span class="label label-success"><font><font>Contact Information </font><font>: </font></font></span>   <font><strong><a href="#"><font>+999999999999</font></a></strong></font><strong>  <a href="tel:+9000000000"><font></font></a>  <i class="fa fa-phone"></i></strong> 
                                        <br>  <br> 
                                    </div>
                                    <div class="pull-left">
                                        <a href="" class="nextad"><font><font class=""> ←  </font></font></a>
                                        <br>
                                    </div>

                                    <div class="col-md-12 border-top-gray share_icon padding-20 border-bottom-gray">
                                        <div class="col-md-2"><i class="fa fa-twitter  fa-2x"></i></div>
                                        <div class="col-md-2"><img class="fa-2x" width="30px" src="<?php echo get_template_directory_uri(); ?>/images/whatsapp.png"></div>
                                        <div class="col-md-2"><i class="fa fa-flag fa-2x"></i></div>
                                        <div class="col-md-2"><i class="fa fa-2x fa-heart" aria-hidden="true"></i></div>
                                        <div class="col-md-2"><i class="fa fa-2x fa-envelope" aria-hidden="true"></i></div>
                                    </div>
                                    <?php the_content(); ?>
                                </div>
                                <?php // appthemes_after_post_content(); ?>

                            </div><!-- /shadowblock -->

                        </div><!-- /shadowblock_out -->

                        <?php appthemes_after_post(); ?>

                    <?php endwhile; ?>

                    <?php appthemes_after_endwhile(); ?>

                <?php else: ?>

                    <?php appthemes_loop_else(); ?>

                <?php endif; ?>

                <div class="clr"></div>

                <?php appthemes_after_loop(); ?>

                <?php wp_reset_query(); ?>

                <div class="clr"></div>

                <?php comments_template('/comments-ad_listing.php'); ?>

            </div><!-- /content_left -->

            <?php get_sidebar('ad'); ?>

            <div class="clr"></div>

        </div><!-- /content_res -->

    </div><!-- /content_botbg -->

</div><!-- /content -->
