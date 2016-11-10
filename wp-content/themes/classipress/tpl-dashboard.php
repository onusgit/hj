<?php
/**
 * Template Name: User Dashboard
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.0
 */
global $i;
?>


<div class="content user-dashboard">
    <div class="content_botbg">
        <div class="content_res">
            <!-- left block -->
            <div class="content_left">
                <div class="shadowblock_out">
                    <div class="shadowblock">
                        <h1 class="single dotted"><?php _e('لوحة التحكم', APP_TD); ?></h1>
                        <?php do_action('appthemes_notices'); ?>
                        <?php if ($listings = cp_get_user_dashboard_listings()) : ?>
                            <?php
                            // build the row counter depending on what page we're on
                            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                            $posts_per_page = $listings->post_count;
                            $i = ( $paged != 1 ) ? ( $paged * $posts_per_page - $posts_per_page ) : 0;
                            ?>

                            <p><?php _e('أدناه سوف تجد قائمة بجميع الإعلانات المبوبة الخاصة بك. انقر على اي  من الخيارات لتنفيذ مهمة معينة. إذا كان لديك أي أسئلة، يرجى الاتصال بمسؤول الموقع.', APP_TD); ?></p>

                            <table border="0" cellpadding="4" cellspacing="1" class="tblwide footable">
                                <thead>
                                    <tr>
                                        <th class="listing-count" data-class="expand">&nbsp;</th>
                                        <th class="listing-title">&nbsp;<?php _e('عنوان', APP_TD); ?></th>
                                        <?php if (current_theme_supports('app-stats')) { ?>
                                            <th class="listing-views" data-hide="phone"><?php _e('المشاهدات', APP_TD); ?></th>
                                        <?php } ?>
                                        <th class="listing-status" data-hide="phone"><?php _e('الحالة', APP_TD); ?></th>
                                        <th class="listing-options" data-hide="phone"><?php _e('خيارات', APP_TD); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($listings->have_posts()) : $listings->the_post();
                                        $i++;
                                        ?>

                                        <?php get_template_part('content-dashboard', get_post_type()); ?>

    <?php endwhile; ?>

                                </tbody>

                            </table>

                            <?php appthemes_pagination('', '', $listings); ?>

<?php else : ?>

                            <div class="pad10"></div>
                            <p class="text-center"><?php _e('You currently have no classified ads.', APP_TD); ?></p>
                            <div class="pad10"></div>

                        <?php endif; ?>

<?php wp_reset_postdata(); ?>

                    </div><!-- /shadowblock -->

                </div><!-- /shadowblock_out -->

            </div><!-- /content_left -->

<?php get_sidebar('user'); ?>

            <div class="clr"></div>

        </div><!-- /content_res -->

    </div><!-- /content_botbg -->

</div><!-- /content -->
