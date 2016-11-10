<?php
/**
 * Template Name: Favorite news
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.2
 */
?>
<div class="content">
    <div class="col-md-9">
        <div class="main-content-area">
            <div class="grid-list">
                <div class="container padding-0">
                    <div class="list-grid-icon">
                        <div class="btn-group width-100per">
                            <button href="#" id="list" class="btn btn-primary">
                                <i class="fa fa-camera-retro  "></i>
                            </button> 
                            <button href="#" id="grid" class="btn btn-primary active">
                                <i class="fa fa-globe"></i>
                            </button>                          
                        </div>
                    </div>
                    <div id="products" class="row margin-0 list-group padding-top-4per">
                        <div class="item col-md-12 nav-hide list-group-item margin-0">
                            <div class="col-md-2 title_nav">نشر في</div>
                            <div class="col-md-2 title_nav">نشرت من قبل</div>
                            <div class="col-md-2 title_nav">مدينة</div>
                            <div class="col-md-6 title_nav">العنوان</div>
                        </div>

                        <?php
                        // show all ads but make sure the sticky featured ads don't show up first
                        $favorites = WeDevs_Favorite_Posts::init()->get_favorites();                        
                        if (!empty($favorites)):
                            $myfavarray = array();
                            foreach ($favorites as $f):
                                $myfavarray[] = $f->post_id;
                            endforeach;
                        endif;                        
                        $query = array(
                            'post_type' => 'ad_listing',
                            'post__in' => $myfavarray
                        );
                        query_posts($query);
                        $total_pages = max(1, absint($wp_query->max_num_pages));
                        get_template_part('loop', 'ad_listing');
                        ?>                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ccol-md-3">
<?php get_sidebar('user'); ?>
    </div>
</div>

