<?php

defined('ABSPATH') OR exit;

//Add Youtube video
add_filter("the_content", "custom_content_after_post");

function custom_content_after_post($content) {
    if (is_single()) {
        global $post;

        $youtube_video = get_post_meta($post->ID, 'Youtube video link', true);

        if (!empty($youtube_video)):
            $youtube = explode('/', $youtube_video);
            $video_id = end($youtube);
            $video_link = "https://www.youtube.com/embed/" . $video_id;
            $content .= sprintf('<iframe width="10000" height="315" src="%s" frameborder="0" allowfullscreen></iframe>', $video_link);
        endif;


        $is_mmvip_post = get_post_meta($post->ID, 'is_mmvip_post', true);

        if (!empty($is_mmvip_post)):
            $mmvip_post_url = get_post_meta($post->ID, 'mmvip_post_url', true);
            $mmvip_post_gallery = get_post_meta($post->ID, 'mmvip_post_gallery', true);


            if (!empty($mmvip_post_gallery)):
                add_unite_gallery();
                $gallery = json_decode($mmvip_post_gallery);
                if (count($gallery) > 1):
                    $post_media_url = get_post_meta($post->ID, 'mmvip_post_media_url', true);

                    $content .=sprintf('<div id="gallery">', '');
                    foreach ($gallery as $k => $media) :
                        if ($k > 0):
                            $img = $post_media_url . '/' . $media;
                            $content .= sprintf('<img src=%s alt=%s data-image=%s data-description=%s style="display:none" />', $img, $post->post_title, $img, $post->post_title);
                        endif;
                    endforeach;
                    $content .=sprintf('</div>', '');
                    ?>
                    <script>
                        jQuery(document).ready(function ($) {
                            jQuery("#gallery").unitegallery({
                                //tile_enable_textpanel: true,
                                tile_textpanel_bg_color: "#3A85E0",
                                tile_textpanel_bg_opacity: 0.8,
                                tile_textpanel_title_color: "yellow",
                                tile_textpanel_title_text_align: "center",
                            });
                        });
                    </script>
                    <?php

                endif;
            //$content .= sprintf('<a href=%s ><h2>Go to makeme vip post</h2></a>', $mmvip_post_url);
            endif;

            if (!empty($mmvip_post_url)):
                $content .= sprintf('<a href=%s ><span>Go to makeme vip post</h2></span>', $mmvip_post_url);
            endif;
        endif;
    }
    return $content;
}

function add_unite_gallery() {
    wp_register_script('unite_gallery_js', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/unitegallery/js/unitegallery.js'), array(), null, true);
    wp_enqueue_script('unite_gallery_js');

    wp_register_script('unite_gallery_tiles_theme_js', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/unitegallery/themes/tiles/ug-theme-tiles.js'), array(), null, true);
    wp_enqueue_script('unite_gallery_tiles_theme_js');

    wp_register_style('unite_gallery_css', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/unitegallery/css/unite-gallery.css'));
    wp_enqueue_style('unite_gallery_css');
}

add_action('post_updated', 'save_post_to_mmvip', 10, 2);

function rel_canonical_with_custom_tag_override() {
    if (!is_singular())
        return;

    global $wp_the_query;
    if (!$id = $wp_the_query->get_queried_object_id())
        return;

    $canonical_url = get_post_meta($id, 'is_mmvip_post', true);
    if ($canonical_url == 'yes') {
        $mmvip_post_url = get_post_meta($id, 'mmvip_post_url', true);
        $link = user_trailingslashit(trailingslashit($mmvip_post_url));
    } else {
        $link = get_permalink($id);
    }
    echo "<link rel='canonical' href='" . esc_url($link) . "' />\n";
}

if (function_exists('rel_canonical')) {
    remove_action('wp_head', 'rel_canonical');
}

// Remove Canonical Link Added By Yoast WordPress SEO Plugin
function at_remove_dup_canonical_link() {
    return false;
}

add_filter('wpseo_canonical', 'at_remove_dup_canonical_link');

add_action('wp_head', 'rel_canonical_with_custom_tag_override');

add_shortcode('mmvip_post_cron', 'mmvip_post_cron_function');

function mmvip_post_cron_function() {
    get_all_mmvip_posts();
}