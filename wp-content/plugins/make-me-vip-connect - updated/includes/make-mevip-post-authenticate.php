<?php
defined('ABSPATH') OR exit;
set_time_limit(1800);

error_reporting(0);

function embed_bootstrap() {
    wp_register_script('bootstrap_js', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/bootstrap/js/bootstrap.min.js'), array(), null, true);
    wp_enqueue_script('bootstrap_js');

    wp_register_style('bootstrap_css', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/bootstrap/css/bootstrap.min.css'));
    wp_enqueue_style('bootstrap_css');
}

function user_authentication() {
    embed_bootstrap();
    //$key = get_user_meta(get_current_user_id(), 'user_makemevip_key');
    $key = get_option('mmvip_user_key');
    if (!empty(($_POST['submit']))):
        //$mmvip_key = $_POST['mmvip_user_key'];
        $post_synch_status = $_POST['mmvip_post_synch_status'];
        $post_publish_status = $_POST['mmvip_post_publish_checkbox'];
        if (!empty($_POST['post_category'])):
            $post_category = implode(',', $_POST['post_category']);
        else:
            $post_category = '';
        endif;
        $post_author = $_POST['post_author'];

        if ($post_publish_status):
            $post_publish_status = 1;
        else:
            $post_publish_status = 0;
        endif;

        if ($post_synch_status):
            $post_synch_status = 1;
        else:
            $post_synch_status = 0;
        endif;
        
        update_option('mmvip_post_publish_status', $post_publish_status);
        update_option('mmvip_post_sync_status', $post_synch_status);
        update_option('mmvip_post_category_display', $post_category);
        update_option('mmvip_post_author', $post_author);

        if (empty($key)):
            $mmvip_key = $_POST['mmvip_user_key'];
            $mmvip_page_id = get_option('my_plugin_page_id', true);
            $store_url = get_permalink($mmvip_page_id);
            $store_url = get_option( 'siteurl' ) . '/?page_id=' .$mmvip_page_id;
            $postdata = "mmvip_key=$mmvip_key&store_url=$store_url";
            $curl = curl_init(MAKE_ME_VIP_SERVER . '/UserDashboard/website_authentication.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($curl, CURLOPT_USERPWD, 'admin@show-up.fr:http2013man');
            //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            $response = curl_exec($curl);
            $resultStatus = curl_getinfo($curl);
            curl_close($curl);
            $res = json_decode($response, true);
           
            if ($res['status'] == 1):
                add_user_meta(get_current_user_id(), 'user_makemevip_key', $res['data']['MmvipWebsite']['mmvip_key']);
                update_option('mmvip_user_key', $res['data']['MmvipWebsite']['mmvip_key']);
            else:
                ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php echo 'No store found.'; ?></p>
                </div>
            <?php
            endif;
        endif;
        if ($post_synch_status == 1):
            get_all_mmvip_posts();
        else:

        endif;

        if ($post_publish_status == 1):
            publish_mmvip_post();
        else:
            un_publish_mmvip_post();
        endif;
//        get_all_mmvip_posts();
        //echo '<script>location.reload();</script>';
        //wp_redirect(apmin_url('admin.php?page=make-me-vip-connect')); 
        endif;
    ?>
    <div class="wrap">
        <form method="post" class="user_authentication_form form">
            <div class="row mmvip_header_row">
                <div class="col-md-6">
                    <img class="img img-responsive" src="<?php echo plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME) . '/assets/images/makemevip_header.png' ?>" />
                </div>
                <div class="col-md-6">
                    <h1>Make Me Vip Connect</h1>
                </div>
            </div>
            <div class="mmvip_separator"></div>
            <div class="mmvip_separator"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mmvip_block">
                        <span>
                            Merci d'avoir télécharger Make Me VIP Connect. <br />
                            Ce plugin vous permet de publier sur votre site les articles publiés sur votre compte sur le site https://www.makemevip.info. <br />
                            Il vous permet également de publier automatiquement sur Make Me VIP les articles que vous publiez sur votre blog.<br />
                            Pour celà, vous devez souscrire à une des offres de Make Me VIP, puis récupérer votre clé unique et compléter les champs ci-dessous.<br />
                        </span> <br />
                        <a class="btn btn-primary" href="<?php echo MAKE_ME_VIP_SERVER ?>" target="_blank">Visite Make Me Vip</a>
                    </div>
                </div>
            </div>

            <div class="mmvip_separator"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mmvip_block">                    

                        <?php if (empty($key)): ?>
                            <h2>Connect</h2>
                            <h4>Clé licence</h4>
                            <input type = "text" class = "makemevip_userkey" name="mmvip_user_key" placeholder = "Clé licence">
                        <?php else: ?>
                            <h2>Connecté</h2>
                            <div class="row">
                                <div class="col-md-12 col-center"> 
                                    <!-- <h4>All ready registered with make me vip</h4> -->
                                    <span name="mmvip_user_key">Clé licence: <?php echo $key ?></span>
                                </div>
                            </div> 
                        <?php endif; ?>                     
                    </div>
                </div>
            </div>

            <div class="mmvip_separator"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mmvip_block">
                        <h2>Setting</h2>
                        <div class="form-group">
                            <?php
                            if (get_option('mmvip_post_publish_status') && get_option('mmvip_post_publish_status') == 0):
                                $c = '';
                            else:
                                $c = 'checked';
                            endif;
                            ?>
                            <div class = "row">
                                <div class="col-md-2"><span class = "input-group"><h5>Statut</h5></span></div>
                                <div class="col-md-10"><input type = "checkbox" name="mmvip_post_publish_checkbox" <?php echo $c; ?> class="form-control makemevip_sync_status"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                            if (get_option('mmvip_post_sync_status') && get_option('mmvip_post_sync_status') == 0):
                                $c = '';
                            else:
                                $c = 'checked';
                            endif;
                            ?>
                            <div class = "row">
                                <div class="col-md-2"><span class = "input-group" for="mmvip_post_publish_checkbox"><h5>Publication automatique des articles Wordpress dans Make Me VIP</h5></span></div>
                                <div class="col-md-10"><input type = "checkbox" id="mmvip_post_publish_checkbox" name="mmvip_post_synch_status" <?php echo $c; ?> class="form-control makemevip_publish_status"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                            $cat_array = array();
                            if (get_option('mmvip_post_category_display')):
                                $cat_array = explode(',', get_option('mmvip_post_category_display'));
                            endif;
                            ?>
                            <div class = "row">
                                <div class="col-md-2"><span class = "input-group"><h5>Catégories où seront publiés les articles rédiger dans Make Me VIP</h5></span></div>
                                <div class="col-md-10">
                                    <?php
                                    $args = array(
                                        'orderby' => 'name',
                                        'hide_empty' => 0,
                                    );
                                    ?>  
                                    <select name="post_category[]" multiple> 
                                        <?php
                                        $categories = get_categories($args);
                                        foreach ($categories as $k => $category) {
                                            if (in_array($category->cat_ID, $cat_array) || $k == 0):
                                                $selected = 'selected';
                                            else:
                                                $selected = '';
                                            endif;
                                            ?>
                                            <option value="<?php echo $category->cat_ID ?>" <?php echo $selected ?> ><?php echo $category->cat_name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>                           
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2"><span class = "input-group"><h5>Auteur</h5></span></div>
                                <div class="col-md-10">
                                    <?php
                                    $users = array_merge(get_users(array('role' => 'Administrator')), get_users(array('role' => 'Contributor')));
                                    ?>
                                    <select name="post_author">
                                        <?php foreach ($users as $k => $u): ?>
                                            <option value="<?php echo $u->data->ID ?>"><?php echo $u->data->user_nicename ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit" value="Enregistrer les modifications">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            $('.makemevip_sync_status').bootstrapSwitch();
            $('#mmvip_post_publish_checkbox').bootstrapSwitch();
        });
    </script>

    <?php
}

function get_all_mmvip_posts() {
    //$key = get_user_meta(get_current_user_id(), 'user_makemevip_key');
    if (get_option('mmvip_post_sync_status') && get_option('mmvip_post_sync_status') == 1):

        $key = get_option('mmvip_user_key');
        $curl = curl_init(MAKE_ME_VIP_SERVER . '/UserDashboard/get_posts_wordpress.json');
        $postdata = "key=$key";
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERPWD, 'admin@show-up.fr:http2013man');
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($curl);
        $resultStatus = curl_getinfo($curl);
        curl_close($curl);
        $res = json_decode($response, true);
        if ($res['status'] == 1):
            $post_author = get_option('mmvip_post_author');
            $post_category_string = get_option('mmvip_post_category_display');
            $post_category = explode(',', $post_category_string);
            $post_publish = get_option('mmvip_post_publish_status');

            if ($post_publish == 1):
                $publish = 'publish';
            else:
                $publish = 'draft';
            endif;

//        $u = get_users(array(
//            'meta_key' => 'user_makemevip_key',
//                ), TRUE);
            $mmvip_post = get_posts(array('meta_key' => 'is_mmvip_post', 'meta_value' => 'yes', 'post_type' => 'any', 'post_status' => 'any', 'posts_per_page' => -1));

            $exist_posts = array();
            foreach ($mmvip_post as $k => $v):
                $exist_posts[] = get_post_meta($v->ID, 'mmvip_post_id', true);
            endforeach;

            foreach ($res['data'] as $k => $d):
                if (!in_array($d['Post']['id'], $exist_posts)):
                    $my_post = array(
                        'post_title' => $d['Post']['title'],
                        'post_content' => $d['Post']['content'],
                        'post_status' => $publish,
                        'post_author' => $post_author,
                        'post_date' => $d['Post']['publish_date'],
                        'post_category' => $post_category,
                    );
                    $my_post_id = wp_insert_post($my_post);
                    if ($my_post_id):
                        $g = json_decode($d['Post']['gallery'], true);
                        $post_media_url = MAKE_ME_VIP_SERVER . '/uploads/posts/' . $d['Post']['id'];
                        $img_url = $post_media_url . '/' . $g[0];
                        add_post_meta($my_post_id, 'mmvip_post_media_url', $post_media_url);
                        add_post_meta($my_post_id, 'mmvip_post_id', $d['Post']['id']);
                        add_post_meta($my_post_id, 'is_mmvip_post', 'yes');
                        add_post_meta($my_post_id, 'mmvip_post_picture', $img_url);
                        add_post_meta($my_post_id, 'mmvip_post_gallery', $d['Post']['gallery']);
                        add_post_meta($my_post_id, 'Youtube video link', $d['Post']['youtube_link']);

                        $post_url = MAKE_ME_VIP_SERVER . '/actualites/' . $d['Category']['slug'] . '/' . $d['Post']['slug'];
                        add_post_meta($my_post_id, 'mmvip_post_url', $post_url);
                        Generate_Featured_Image($img_url, $my_post_id);
                    endif;
                else:

                endif;
            endforeach;

            if ($res['status'] == 1):
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php echo 'Post has been updated'; ?></p>
                </div>                    
                <?php 
            endif; 
            

        endif;
    endif;
}

function Generate_Featured_Image($image_url, $post_id) {
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);

    $picture = explode('/', $image_url);
    $picture = end($picture);

    $filename = $picture;
    if (wp_mkdir_p($upload_dir['path']))
        $file = $upload_dir['path'] . '/' . $filename;
    else
        $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    $res1 = wp_update_attachment_metadata($attach_id, $attach_data);
    $res2 = set_post_thumbnail($post_id, $attach_id);
}

function un_publish_mmvip_post() {
    $mmvip_post = get_posts(array('meta_key' => 'is_mmvip_post', 'meta_value' => 'yes', 'post_type' => 'any', 'post_status' => 'any', 'posts_per_page' => -1));
    foreach ($mmvip_post as $k => $v):
        $post = get_post($v->ID, ARRAY_A);
        $post['post_status'] = 'draft';
        wp_update_post($post);
    endforeach;
}

function publish_mmvip_post() {
    $mmvip_post = get_posts(array('meta_key' => 'is_mmvip_post', 'meta_value' => 'yes', 'post_type' => 'any', 'post_status' => 'any', 'posts_per_page' => -1));
    foreach ($mmvip_post as $post) :
        $post = get_post($post->ID, ARRAY_A);
        $post['post_status'] = 'publish';
        wp_update_post($post);
    endforeach;
}
