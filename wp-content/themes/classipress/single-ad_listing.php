<?php
/**
 * The Template for displaying all single ads.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.0
 * 
 * post meta
 * (
    [cp_city] => Array
        (
            [0] => مكه
        )

    [cp_sys_ad_conf_id] => Array
        (
            [0] => 824581c31c2cef4b
        )

    [cp_sys_userIP] => Array
        (
            [0] => 175.142.114.213
        )

    [cp_sys_ad_duration] => Array
        (
            [0] => 90
        )

    [cp_sys_total_ad_cost] => Array
        (
            [0] => 0
        )

    [cp_sys_expire_date] => Array
        (
            [0] => 2017-02-02 07:01:34
        )
 * 
 * $post
 *     [ID] => 115
    [post_author] => 2
    [post_date] => 2016-11-05 03:29:14
    [post_date_gmt] => 2016-11-05 03:29:14
    [post_content] => موقع هي على المعلن ولاتبرأ ذمة المعلن من العمولة إلا في حال دفعها،ذمة المعلن لاتبرأ من العمولة بمجرد ذكر أن العمولة على المشتري في الإعلان أتعهد أنا المعلن أن جميع المعلومات التي سوف أذكرها بالإعلان صحيحة وفي القسم الصحيح وأتعهد أن الصور التي سوف يتم عرضها هي صور حديثة لنفس السياره. وليست لسياره أخرى مشابهه أتعهد انا المعلن أن أقوم بدفع العمولة خلال أقل من 10 أيام من تاريخ إستلام كامل سعر السلعه.
    [post_title] => سيارة
    [post_excerpt] => 
    [post_status] => publish
    [comment_status] => open
    [ping_status] => open
    [post_password] => 
    [post_name] => %d8%b3%d9%8a%d8%a7%d8%b1%d8%a9
    [to_ping] => 
    [pinged] => 
    [post_modified] => 2016-11-05 03:29:14
    [post_modified_gmt] => 2016-11-05 03:29:14
    [post_content_filtered] => سيارة, موقع هي على المعلن ولاتبرأ ذمة المعلن من العمولة إلا في حال دفعها،ذمة المعلن لاتبرأ من العمولة بمجرد ذكر أن العمولة على المشتري في الإعلان أتعهد أنا المعلن أن جميع المعلومات التي سوف أذكرها بالإعلان صحيحة وفي القسم الصحيح وأتعهد أن الصور التي سوف يتم عرضها هي صور حديثة لنفس السياره. وليست لسياره أخرى مشابهه أتعهد انا المعلن أن أقوم بدفع العمولة خلال أقل من 10 أيام من تاريخ إستلام كامل سعر السلعه., الطائف, 950581d5200c0838, 2000
    [post_parent] => 0
    [guid] => http://kharjstore.com/?post_type=ad_listing&#038;p=115
    [menu_order] => 0
    [post_type] => ad_listing
    [post_mime_type] => 
    [comment_count] => 0
    [filter] => raw
 * 
 */
?>
<div class="content">
    <div class="content_botbg">
        <div class="content_ads">
            <!--<div id="breadcrumb"><?php // cp_breadcrumb();                ?></div>-->
            <div class="clr"></div>
            <div class="content_left_ads">
                <?php
                do_action('appthemes_notices');
                appthemes_before_loop();
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        appthemes_before_post();
                        $post_meta = get_post_meta($post->ID);
                        $author =  get_userdata( $post->post_author); 
                        /*[data] => stdClass Object
        (
                            [ID] => 2
                            [user_login] => nagdawi
                            [user_pass] => $P$Bgix7tL2rfGj4ErkumOlHn0FFr/bz61
                            [user_nicename] => nagdawi
                            [user_email] => nagdawi@yahoo.com
                            [user_url] => 
                            [user_registered] => 2016-10-15 15:27:50
                            [user_activation_key] => 
                            [user_status] => 0
                            [display_name] => nagdawi
                        )*/                      
                        appthemes_stats_update($post->ID); //records the page hit 
                        ?>
                        <div class="shadowblock_out <?php cp_display_style('featured'); ?>">
                            <div class="shadowblock">
                                <?php // appthemes_before_post_title();  ?>
                                <!--<h1 class="single-listing"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php // the_title();               ?></a></h1>-->
                                <div class="clr"></div>
        <?php // appthemes_after_post_title();  ?>
                                <!--<div class="pad5 dotted"></div>-->
                                <div class=" row ad_high margin-0">
                                    <h3 itemprop="name"><font><font> »<?php the_title(); ?></font></font></h3>
                                    <div class=" comment_header">
                                        <!--&nbsp; <a href="https://haraj.com.sa/users/qwqw0000" class="username"><font><font>qwqw0000</font></font></a>-->
                                        <font><font>  <?php echo appthemes_display_date($post->post_date); ?> </font></font>

                                        <br><font><font> 
                                        <font>رقم الاعلان :<font>
                                            <?php // echo isset($post_meta['cp_sys_ad_conf_id'][0])?$post_meta['cp_sys_ad_conf_id'][0]:''?>
                                        <strong><?php if ( get_post_meta( $post->ID, 'cp_sys_ad_conf_id', true ) ) echo get_post_meta( $post->ID, 'cp_sys_ad_conf_id', true ); else _e( 'N/A', APP_TD ); ?></strong>
                                        </font></font>
                                        </font></font>                                        
                                    </div>

                                </div>
                                <div class="bigright padding-top-20 <?php // cp_display_style('ad_single_images');                ?>">

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

                                       <!--  <li id="cp_listed"><span><?php _e('Listed:', APP_TD); ?></span> <?php echo appthemes_display_date($post->post_date); ?></li>
                                        <?php if ($expire_date = get_post_meta($post->ID, 'cp_sys_expire_date', true)) { ?>
                                            <li id="cp_expires"><span><?php _e('Expires:', APP_TD); ?></span> <?php echo cp_timeleft($expire_date); ?></li>
                                        <?php } ?> -->

                                    </ul>

                                </div><!-- /bigright -->
                                <?php if ($cp_options->ad_images) { ?>
                                    <div class="bigleft">
                                        <?php
                                        $images = get_children(array('post_parent' => $post->ID, 'post_status' => 'inherit', 'numberposts' => 1, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'ID'));
                                        if ($images) {
                                            ?>
                                            <div id="main-pic">                                            
                                                <?php
                                                // move over bacon
                                                $image = array_shift($images);
                                                $alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
                                                // grab the large image for onhover preview
                                                $adlargearray = wp_get_attachment_image_src($image->ID, 'large');
                                                $img_large_url_raw = $adlargearray[0];

                                                // must be a v3.0.5+ created ad
                                                if ($adlargearray) {
                                                    echo '<a href="' . $img_large_url_raw . '" class="img-main" data-rel="colorbox" title="' . the_title_attribute('echo=0') . '"><img src="' . $img_large_url_raw . '" title="' . $alt . '" alt="' . $alt . '" /></a>';
                                                }
                                                ?>
                                                <div class="clr"></div>
                                            </div>

                                            <?php
                                            // no image so return the placeholder thumbnail
                                        }
//                                            else {
//                                                echo '<img class="attachment-medium" alt="" title="" src="' . appthemes_locate_template_uri('images/no-thumb.jpg') . '" />';
//                                            }
//                                            cp_get_image_url();
                                        ?>
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
                                    <div class="contact padding-top-20">
                                        <span class="label label-success"><font><font>Email</font><font>: </font></font></span>
                                        <font><strong><a href="mailto:<?php echo $author->user_email; ?>"><font><?php echo $author->user_email; ?></font></a></strong>
                                                
                                        </font>
<!--                                        <strong>  <a href="mailto:<?php echo $author->user_email; ?>"><font></font></a> 
                                            <i class="fa fa-envelope"></i>
                                        </strong> -->
                                        <br>  <br> 
                                    </div>
                                    <!--                                    <div class="pull-left">
                                                                            <a href="" class="nextad"><font><font class=""> ←  </font></font></a>
                                                                            <br>
                                                                        </div>-->

                                    <div class="col-md-12 border-top-gray share_icon padding-20 border-bottom-gray">
<!--                                        <div class="col-md-2"><i class="fa fa-twitter  fa-2x"></i></div>
                                        <div class="col-md-2"><img class="fa-2x" width="30px" src="<?php echo get_template_directory_uri(); ?>/images/whatsapp.png"></div>
                                        <div class="col-md-2"><i class="fa fa-flag fa-2x"></i></div>
                                        <div class="col-md-2"><i class="fa fa-2x fa-heart" aria-hidden="true"></i></div>-->
                                        <div class="col-md-2"><a href="mailto:<?php echo $author->user_email; ?>"><i class="fa fa-2x fa-envelope" aria-hidden="true"></i></a></div>
                                    </div>
                                <?php the_content(); ?>
                                </div>
        <?php // appthemes_after_post_content();   ?>

                            </div><!-- /shadowblock -->

                        </div><!-- /shadowblock_out -->

                        <?php appthemes_after_post();
                        ?>

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

<?php // get_sidebar('ad');   ?>
            <div class="content_right suggest_post">       

                إعلانات أخرى لـ: <a href="#" class="username">راعي السوبارو</a>
                <br><br>
                <ul class="list-unstyled">
                    <li><a href="#"> »  اثاث مستعمل للبيع </a></li>
                    <li><a href="#"> » راوتر موبايلي و stc للبيع</a></li>
                    <li><a href="#"> » جينيسس بلاتينيوم 2016 للتنازل</a></li>
                    <li><a href="#"> » هيونداي جينيسس 2016</a></li>
                    <li><a href="#"> » هيونداي جينيسس رويال 6 سلندر 2016 </a></li>
                </ul>

                <div class="main-col">
                    <div class="row">
                        <ul class="text-center">
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                            <li><a href="#"><img src="https://imgcdn.haraj.com.sa/cache2/b38fbB91CE02e8.jpg" alt="" class="img-rounded"></a></li>
                        </ul>
                        <p class="text-left"><b><a class="red" href="#">السيارات المصورة   </a></b></p>
                    </div>
                </div>
            </div>
            <div class="clr"></div>

        </div><!-- /content_res -->

    </div><!-- /content_botbg -->

</div><!-- /content -->
<?php echo do_shortcode('[front-end-pm]') ?>