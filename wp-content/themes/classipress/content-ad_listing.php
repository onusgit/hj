<?php
/**
 * Listing loop content template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
global $cp_options;
?>

<div class="item col-xs-4 col-lg-4 list-group-item">
    <div class="thumbnail">        
        <div class="group list-group-image hide">
            <?php            
            if ($cp_options->ad_images) cp_ad_loop_thumbnail(); ?>            
        </div>        
        <div class="caption">
            <div class="group inner list-group-item-heading col-md-2">
                <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago'); ?>
            </div>
            <div class="group inner list-group-item-heading col-md-2">
               <?php echo get_the_author(); ?></div>
            <div class="group inner list-group-item-heading col-md-2">
                <?php 
                $post_meta = get_post_meta(get_the_ID());
                if(isset($post_meta['cp_city'][0]) && !empty($post_meta['cp_city'][0])):
                    echo $post_meta['cp_city'][0];
                endif;                
                ?>
            </div>
            <div class="group inner list-group-item-text col-md-6">
                <a href="<?php the_permalink(); ?>">
                    
                    <div class="offer">
                    <?php
                    if (mb_strlen(get_the_title()) >= 75):
                        echo mb_substr(get_the_title(), 0, 75) . '...';?>
                        <i class="fa  <?php if(cp_ad_loop_thumbnail_check() == 1): echo 'fa-camera-retro'; endif;?> font-18 black"></i>
                        <?php
                    else:
                        the_title();?>
                        <i class="fa  <?php if(cp_ad_loop_thumbnail_check() == 1): echo 'fa-camera-retro'; endif;?> font-18 black"></i>
                        <?php
                    endif;
                    ?>
                    </div>
                </a>
            </div>            
        </div>
    </div>
</div>  
<?php /* 
<div class="post-block-out <?php cp_display_style('featured'); ?>">

    <div class="post-block">

        <div class="post-left">

            <?php if ($cp_options->ad_images) cp_ad_loop_thumbnail(); ?>

        </div>

        <div class="<?php cp_display_style(array('ad_images', 'ad_class')); ?>">

            <?php appthemes_before_post_title(); ?>

            <h3>
                <a href="<?php the_permalink(); ?>">
                    <?php
                    if (mb_strlen(get_the_title()) >= 75)
                        echo mb_substr(get_the_title(), 0, 75) . '...';
                    else
                        the_title();
                    ?></a>
            </h3>

            <div class="clr"></div>

            <?php appthemes_after_post_title(); ?>

            <div class="clr"></div>

            <?php appthemes_before_post_content(); ?>

            <p class="post-desc"><?php echo cp_get_content_preview(160); ?></p>

            <?php appthemes_after_post_content(); ?>

            <div class="clr"></div>

        </div>

        <div class="clr"></div>

    </div><!-- /post-block -->

</div><!-- /post-block-out -->
*/ ?>