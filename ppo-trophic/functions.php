<?php
######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
include 'libs/HttpFoundation/Response.php';
include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/common-scripts.php';
include 'libs/meta-box.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/custom-user.php';
include 'includes/widgets/ads.php';
include 'includes/widgets/category-product-grid.php';
include 'includes/product.php';
include 'includes/ppocart.php';
include 'includes/orders.php';
include 'includes/product-metabox.php';
include 'ajax.php';
if (is_admin()) {
    $basename_excludes = array('plugin-install.php', 'plugin-editor.php', 'themes.php', 'theme-editor.php', 
        'tools.php', 'import.php', 'export.php');
    if (in_array($basename, $basename_excludes)) {
        wp_redirect(admin_url());
    }

    include 'libs/ppofeedback.php';
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
//    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
}

function remove_menu_editor() {
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_theme_setup")) {

    function ppo_theme_setup() {
        ## Enable Links Manager (WP 3.5 or higher)
//        add_filter('pre_option_link_manager_enabled', '__return_true');

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }
        add_image_size('60x50', 60, 50, true);
        /* if (function_exists('add_image_size')) {
          add_image_size('thumbnail176', 176, 176, FALSE);
          } */
        
        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
            'topmenu' => 'Top Menu',
        ));
    }

}

add_action('after_setup_theme', 'ppo_theme_setup');
/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_widgets_init")) {

    // Register Sidebar
    function ppo_widgets_init() {
        register_sidebar(array(
            'id' => __('sidebar'),
            'name' => __('Sidebar'),
            'before_widget' => '<div id="%1$s" class="widget-container widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'id' => __('footersidebar'),
            'name' => __('FooterSidebar'),
            'before_widget' => '<div class="col-xs-6 col-md-3 cotfooter"> <div class="list-left">',
            'after_widget' => '</div></div>',
            'before_title' => '<p class="widgettitlefooter">',
            'after_title' => '</p>',
        ));
        register_sidebar(array(
            'name' => __('Home Page Sidebar', 'ppotext'),
            'id' => 'homepagesidebar',
            'description' => __('Home Page Sidebar Widget Area', 'ppotext'),
            'before_widget' => "<div class='widget'>",
            'after_widget' => "</div>",
            'before_title' => "<h3>",
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Home Main Sidebar', 'ppotext'),
            'id' => 'homemainsidebar',
            'description' => __('Home Main Sidebar Widget Area', 'ppotext'),
            'before_widget' => "<div class='widget'>",
            'after_widget' => "</div>",
            'before_title' => "",
            'after_title' => '',
        ));
    }

    // Register widgets
    register_widget('Ads_Widget');
    register_widget('Category_Product_Grid_Widget');
}

add_action('widgets_init', 'ppo_widgets_init');

/* ----------------------------------------------------------------------------------- */
# Unset size of post thumbnails
/* ----------------------------------------------------------------------------------- */

function ppo_filter_image_sizes($sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

add_filter('intermediate_image_sizes_advanced', 'ppo_filter_image_sizes');
/*
  function ppo_custom_image_sizes($sizes){
  $myimgsizes = array(
  "image-in-post" => __("Image in Post"),
  "full" => __("Original size")
  );

  return $myimgsizes;
  }

  add_filter('image_size_names_choose', 'ppo_custom_image_sizes');
 */
/* ----------------------------------------------------------------------------------- */
# User login
/* ----------------------------------------------------------------------------------- */
add_action('init', 'redirect_after_logout');

function redirect_after_logout() {
    if (preg_match('#(wp-login.php)?(loggedout=true)#', $_SERVER['REQUEST_URI']))
        wp_redirect($_SERVER['HTTP_REFERER']);
}

function get_history_order() {
    global $wpdb, $current_user;
    get_currentuserinfo();
    $records = array();
    if (is_user_logged_in()) {
        $tblOrders = $wpdb->prefix . 'orders';
        $query = "SELECT $tblOrders.*, $wpdb->users.display_name, $wpdb->users.user_email FROM $tblOrders 
            JOIN $wpdb->users ON $wpdb->users.ID = $tblOrders.customer_id 
            WHERE $tblOrders.customer_id = $current_user->ID ORDER BY $tblOrders.ID DESC";
        $records = $wpdb->get_results($query);
    }
    return $records;
}

//PPO Feed all post type

function ppo_feed_request($qv) {
    if (isset($qv['feed']))
        $qv['post_type'] = get_post_types();
    return $qv;
}

add_filter('request', 'ppo_feed_request');

/* ----------------------------------------------------------------------------------- */
# Language
/* ----------------------------------------------------------------------------------- */

function getLocale() {
    $locale = "vn";
    if (get_query_var("lang") != null) {
        $locale = get_query_var("lang");
    } else if (function_exists("qtrans_getLanguage")) {
        $locale = qtrans_getLanguage();
    } else if (defined('ICL_LANGUAGE_CODE')) {
        $locale = ICL_LANGUAGE_CODE;
    }
    if ($locale == "vi") {
        $locale = "vn";
    }
    return $locale;
}
/*
function languages_list_flag() {
    if (function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if (!empty($languages)) {
            foreach ($languages as $l) {
                if (!$l['active'])
                    echo '<a href="' . $l['url'] . '">';
                echo '<img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" />';
                if (!$l['active'])
                    echo '</a>';
            }
        }
    }
}

function languages_list_li() {
    if (function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');

        if (!empty($languages)) {
            foreach ($languages as $l) {
                echo '<li>';
                if (!$l['active'])
                    echo '<a href="' . $l['url'] . '">';
                echo icl_disp_language($l['native_name'], $l['translated_name']);
                if (!$l['active'])
                    echo '</a>';
                echo '</li>';
            }
        }
    }
}*/

/* ----------------------------------------------------------------------------------- */
# Register menu location
/* ----------------------------------------------------------------------------------- */

function admin_add_custom_js() {
    ?>
    <script type="text/javascript">/* <![CDATA[ */
        jQuery(function($) {
            var area = new Array();

            $.each(area, function(index, id) {
                //tinyMCE.execCommand('mceAddControl', false, id);
                tinyMCE.init({
                    selector: "textarea#" + id,
                    height: 400
                });
                $("#newmeta-submit").click(function() {
                    tinyMCE.triggerSave();
                });
            });

            $(".submit input[type='submit']").click(function() {
                if (typeof tinyMCE != 'undefined') {
                    tinyMCE.triggerSave();
                }
            });

        });
        /* ]]> */
    </script>
    <?php
}

add_action('admin_print_footer_scripts', 'admin_add_custom_js', 99);

function pre_get_image_url($url, $show = true) {
    if (trim($url) == "")
        $url = get_template_directory_uri() . "/images/no_image_available.jpg";
    if ($show)
        echo $url;
    else
        return $url;
}

/* ----------------------------------------------------------------------------------- */
# Custom search
/* ----------------------------------------------------------------------------------- */
add_action('pre_get_posts', 'custom_search_filter');

function custom_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        $post_type = 'product';
        $post_types = array('post', 'product');
        $products_per_page = intval(get_option(SHORT_NAME . "_product_pager"));
        if($query->is_tag){
            $query->set('post_type', $post_types);
        } else if($query->is_home){
            $query->set('post_type', $post_type);
            $query->set('posts_per_page', 24);
        } else if ($query->is_search) {
            $query->set('post_type', $post_type);
            $query->set('posts_per_page', $products_per_page);
        } else if (is_tax('product_category') or is_tax('product_factor')){
            $query->set('posts_per_page', $products_per_page);
        }
    }
    return $query;
}

/*
  add_filter('posts_where', 'title_like_posts_where');

  function title_like_posts_where($where){
  global $wpdb, $wp_query;
  if($wp_query->is_search){
  $where = str_replace("AND ((ppo_postmeta.meta_key =", "OR ((ppo_postmeta.meta_key =", $where);
  }
  return $where;
  }
 */

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
        show_admin_bar(false);
    }
}