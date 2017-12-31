<?php

/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_post_type');

function create_product_post_type() {
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Sản phẩm'),
            'singular_name' => __('Products'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Product'),
            'new_item' => __('New Product'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Product'),
            'view' => __('View Product'),
            'view_item' => __('View Product'),
            'search_items' => __('Search Products'),
            'not_found' => __('No Product found'),
            'not_found_in_trash' => __('No Product found in trash'),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'author', 'thumbnail', 
            //'custom-fields', 'comments', 'excerpt',
        ),
        'rewrite' => array('slug' => 'san-pham', 'with_front' => false),
        'can_export' => true,
        'description' => __('Product description here.'),
        'taxonomies' => array('post_tag'),
    ));
}

/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_taxonomies');

function create_product_taxonomies() {
    register_taxonomy('product_category', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Danh mục sản phẩm'),
            'singular_name' => __('Product Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
        'rewrite' => array('slug' => 'danh-muc', 'with_front' => false),
    ));
    register_taxonomy('product_factor', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Nhà cung cấp'),
            'singular_name' => __('Product Factors'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Factor'),
            'new_item' => __('New Factor'),
            'search_items' => __('Search Factors'),
        ),
        'rewrite' => array('slug' => 'nha-cung-cap', 'with_front' => false),
    ));
}


/* ----------------------------------------------------------------------------------- */
# Meta box
/* ----------------------------------------------------------------------------------- */
$product_meta_box = array(
    'id' => 'product-meta-box',
    'title' => 'Thông tin sản phẩm',
    'page' => 'product',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Mã sản phẩm (SKU)',
            'desc' => '',
            'id' => 'ma_sp',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => '<strike>Giá thị trường</strike>',
            'desc' => 'Ví dụ: 100000',
            'id' => 'gia_cu',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Giá bán',
            'desc' => 'Ví dụ: 77000',
            'id' => 'gia_moi',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Giảm giá (%)',
            'desc' => "Ví dụ: 23",
            'id' => 'discount',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Tình trạng',
            'desc' => '',
            'id' => 'tinh_trang',
            'type' => 'radio',
            'std' => 'Còn hàng',
            'options' => array(
                'Còn hàng' => 'Còn hàng',
                'Hết hàng' => 'Hết hàng',
                'Sắp có hàng' => 'Sắp có hàng',
            )
        ),
        array(
            'name' => 'Sản phẩm nổi bật',
            'desc' => '',
            'id' => 'not_in_feature',
            'type' => 'radio',
            'std' => '',
            'options' => array(
                '1' => 'Yes',
                '0' => 'No'
            )
        ),
        array(
            'name' => 'Giới thiệu ngắn gọn',
            'desc' => '',
            'id' => 'product_short',
            'type' => 'textarea',
            'std' => '',
            'btn' => true,
        ),
    )
);
 //Add product meta box
if (is_admin()) {
    add_action('admin_menu', 'product_add_box');
    add_action('save_post', 'product_add_box');
    add_action('save_post', 'product_save_data');
    add_action('publish_product', 'product_publish_data');
}

function product_add_box() {
    global $product_meta_box;
    add_meta_box($product_meta_box['id'], $product_meta_box['title'], 'product_show_box', $product_meta_box['page'], $product_meta_box['context'], $product_meta_box['priority']);
}

/**
 * Callback function to show fields in product meta box
 * @global array $product_meta_box
 * @global Object $post
 * @global array $area_fields
 */
function product_show_box() {
    global $product_meta_box, $post;
    custom_output_meta_box($product_meta_box, $post);
}

/**
 * Save data from product meta box
 * @global array $product_meta_box
 * @global array $area_fields
 * @param Object $post_id
 * @return 
 */
function product_save_data($post_id) {
    global $product_meta_box;
    custom_save_meta_box($product_meta_box, $post_id);
    return $post_id;
}

function product_publish_data($post_id){
    $purchases = get_post_meta($post_id, "purchases", true);
    
    if(!$purchases or $purchases == ""){
        if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {
            update_post_meta($post_id, 'purchases', 0);
        }
    }
    
    return $post_id;
}
/***************************************************************************/
// ADD NEW COLUMN  
function product_columns_head($defaults) {
    //$defaults['is_most'] = 'Nổi bật';
    $defaults['tinh_trang'] = 'Status';
    $defaults['orders'] = 'Orders';
    return $defaults;
}

// SHOW THE COLUMN
function product_columns_content($column_name, $post_id) {
    switch ($column_name) {
        case 'is_most':
            $is_most = get_post_meta( $post_id, 'is_most', true );
            if($is_most == 1){
                echo '<a href="edit.php?update_is_most=true&post_id=' . $post_id . '&is_most=' . $is_most . '&redirect_to=' . urlencode(getCurrentRquestUrl()) . '">Yes</a>';
            }else{
                echo '<a href="edit.php?update_is_most=true&post_id=' . $post_id . '&is_most=' . $is_most . '&redirect_to=' . urlencode(getCurrentRquestUrl()) . '">No</a>';
            }
            break;
        case 'tinh_trang':
            $tinh_trang = get_post_meta($post_id, "tinh_trang", true);
            switch ($tinh_trang) {
                case "Còn hàng":
                    echo '<span class="bold" style="color:green">Còn hàng</span>';
                    break;
                case "Hết hàng":
                    echo '<span class="bold" style="color:orange">Hết hàng</span>';
                    break;
                case "Sắp có hàng":
                    echo '<span class="bold" style="color:red">Sắp có hàng</span>';
                    break;
                default:
                    break;
            }
            break;
        case 'orders':
            echo '<a href="admin.php?page=nvt_orders&product_id=' . $post_id . '" target="_blank">View</a>';
            break;
        default:
            break;
    }
}

// Update is most stataus
function update_product_is_most(){
    if(getRequest('update_is_most') == 'true'){
        $post_id = getRequest('post_id');
        $is_most = getRequest('is_most');
        $redirect_to = urldecode(getRequest('redirect_to'));
        if($is_most == 1){
            update_post_meta($post_id, 'is_most', 0);
        }else{
            update_post_meta($post_id, 'is_most', 1);
        }
        header("location: $redirect_to");
        exit();
    }
}

add_filter('manage_product_posts_columns', 'product_columns_head');  
add_action('manage_product_posts_custom_column', 'product_columns_content', 10, 2);  
add_filter('admin_init', 'update_product_is_most');  

function sortable_product_is_most_column( $columns ) {  
    $columns['is_most'] = 'is_most';
    $columns['tinh_trang'] = 'tinh_trang';
    return $columns;
}

function product_is_most_orderby( $query ) {  
    if( ! is_admin() )  
        return;  
  
    $orderby = $query->get( 'orderby');  
  
    switch ($orderby) {
        case 'is_most':
            $query->set('meta_key','is_most');  
            $query->set('orderby','meta_value_num');  
            break;
        case 'tinh_trang':
            $query->set('meta_key','tinh_trang');  
            $query->set('orderby','meta_value');  
            break;
        default:
            break;
    }
}

add_filter( 'manage_edit-product_sortable_columns', 'sortable_product_is_most_column' );  
add_action( 'pre_get_posts', 'product_is_most_orderby' );  

# Add custom field to quick edit

//add_action( 'bulk_edit_custom_box', 'quickedit_products_custom_box', 10, 2 );
add_action('quick_edit_custom_box', 'quickedit_products_custom_box', 10, 2);

function quickedit_products_custom_box( $col, $type ) {
    if( $col != 'tinh_trang' || $type != 'product' ) {
        return;
    }

    $tinh_trang = array(
        'Còn hàng' => 'Còn hàng',
        'Hết hàng' => 'Hết hàng',
        'Sắp có hàng' => 'Sắp có hàng',
    );
?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col product-custom-fields">
            <div class="inline-edit-group">
                <label class="alignleft">
                    <span class="title">Giá thị trường</span>
                    <input type="text" name="gia_cu" id="gia_cu" value="" />
                    <span class="spinner" style="display: none;"></span>
                </label>
            </div>
            <div class="inline-edit-group">
                <label class="alignleft">
                    <span class="title">Giá bán</span>
                    <input type="text" name="gia_moi" id="gia_moi" value="" />
                    <span class="spinner" style="display: none;"></span>
                </label>
            </div>
            <div class="inline-edit-group">
                <label class="alignleft">
                    <span class="title">Giảm giá</span>
                    <input type="text" name="discount" id="discount" value="" />
                    <span class="spinner" style="display: none;"></span>
                </label>
            </div>
            <div class="inline-edit-group">
                <label class="alignleft">
                    <span class="title">Tình trạng</span>
                    <select name="tinh_trang" id='tinh_trang'>
                        <?php
                        foreach ($tinh_trang as $k => $v) {
                            echo "<option value='{$k}'>{$v}</option>";
                        }
                        ?>
                    </select>
                    <span class="spinner" style="display: none;"></span>
                </label>
            </div>
        </div>
    </fieldset>
<?php
}

add_action('save_post', 'product_save_quick_edit_data');
 
function product_save_quick_edit_data($post_id) {
    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
    // to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;   
    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } else {
        if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }
    // OK, we're authenticated: we need to find and save the data
    $post = get_post($post_id);
    $fields = array('gia_cu', 'gia_moi', 'discount', 'tinh_trang');
    foreach ($fields as $field) {
        if (isset($_POST[$field]) && ($post->post_type != 'revision')) {
            $meta = esc_attr($_POST[$field]);
            if ($meta)
                update_post_meta( $post_id, $field, $meta);
        }
    }
    
    return $post_id;
}

add_action( 'admin_print_scripts-edit.php', 'product_enqueue_edit_scripts' );
function product_enqueue_edit_scripts() {
   wp_enqueue_script( 'product-admin-edit', get_bloginfo( 'stylesheet_directory' ) . '/libs/js/quick_edit.js', array( 'jquery', 'inline-edit-post' ), '', true );
}

//////////////////
//add extra fields to tag edit form hook
add_action('product_factor_add_form_fields', 'product_factor_add_extra_tag_fields');
//add_action('edit_tag_form_fields', 'product_extra_tag_fields');
add_action('product_factor_edit_form_fields', 'product_factor_extra_tag_fields');

//add extra fields to category edit form callback function
function product_factor_add_extra_tag_fields() {
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="tag_meta_img"><?php _e('Image'); ?></label></th>
        <td>
            <input type="text" name="tag_meta[img]" id="tag_meta_img" style="width:80%;" value=""/>
            <button type="button" onclick="uploadByField('tag_meta_img')" class="button button-upload" id="upload_tag_meta_img_button" />Upload</button><br />
            <span class="description"></span><br /><br />
        </td>
    </tr>
    <?php
}
function product_factor_extra_tag_fields($tag) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $tag_meta = get_option("tag_$t_id");
    ?>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="tag_meta_img"><?php _e('Image'); ?></label></th>
        <td>
            <input type="text" name="tag_meta[img]" id="tag_meta_img" style="width:84%;" value="<?php echo $tag_meta['img'] ? $tag_meta['img'] : ''; ?>">
            <button type="button" onclick="uploadByField('tag_meta_img')" class="button button-upload" id="upload_tag_meta_img_button" />Upload</button><br />
            <span class="description"></span>
        </td>
    </tr>
    <?php
}

// save extra tag extra fields hook
add_action('edited_terms', 'product_save_extra_tag_fileds');
add_action('create_term', 'product_save_extra_tag_fileds');

// save extra tag extra fields callback function
function product_save_extra_tag_fileds($term_id) {
    if (isset($_POST['tag_meta'])) {
        $t_id = $term_id;
        $tag_meta = get_option("tag_$t_id");
        $tag_keys = array_keys($_POST['tag_meta']);
        foreach ($tag_keys as $key) {
            if (isset($_POST['tag_meta'][$key])) {
                $tag_meta[$key] = stripslashes_deep($_POST['tag_meta'][$key]);
            }
        }
        //save the option array
        update_option("tag_$t_id", $tag_meta);
    }
}

//these filters will only affect custom column, the default column will not be affected
//filter: manage_edit-{$taxonomy}_columns
function product_factor_custom_column_header($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumb'] = __('Image');

    unset( $columns['cb'] );

    return array_merge( $new_columns, $columns );
}

add_filter("manage_edit-product_factor_columns", 'product_factor_custom_column_header', 10);

function product_factor_column_content($columns, $column_name, $tax_id) {
    $tag_meta = get_option("tag_$tax_id");
    //for multiple custom column, you may consider using the column name to distinguish
    if ($column_name === 'thumb') {
        $columns = '<span><img src="' . $tag_meta['img'] . '" alt="' . __('Thumbnail') . '" class="wp-post-image" style="max-width: 100%" /></span>';
    }
    return $columns;
}

add_action("manage_product_factor_custom_column", 'product_factor_column_content', 10, 3);