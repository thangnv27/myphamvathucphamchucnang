<?php

class Category_Product_Grid_Widget extends WP_Widget {

    function Category_Product_Grid_Widget() {
        $widget_ops = array('classname' => 'cat-product-grid-widget', 'description' => 'Sản phẩm theo danh mục.');
        $control_ops = array('id_base' => 'cat_product_grid_widget');
        $this->WP_Widget('cat_product_grid_widget', 'PPO: Products Grid', $widget_ops, $control_ops);
    }

    /**
     * Displays category posts widget on blog.
     *
     * @param array $instance current settings of widget .
     * @param array $args of widget area
     */
    function widget($args, $instance) {
        global $post;
        extract($args);

        $taxonomy = 'product_category';
        $title = apply_filters('widget_title', $instance['title']);
        $term_id = trim($instance["cat"]);
        $category_info = get_term($term_id, $taxonomy);
        // If not title, use the name of the category.
        if (!$instance["widget_title"]) {
            $title = $category_info->name;
        }
        
        echo $before_widget;
        // Widget title
        echo $before_title;
        echo $after_title;
        ?>
        <div class="tieude_home">
            <h3 class="title_link">
                <a href="<?php echo get_term_link($category_info, $taxonomy) ?>" title="<?php echo ucfirst($category_info->name); ?>" class="title_link_a"><span class="glyphicon glyphicon-th-list"></span><?php echo ucfirst($category_info->name); ?></a>
            </h3>
            <div class="link-cat">
                <?php
                $catChilds = get_categories(array(
                    'type' => 'product',
                    'taxonomy' => $taxonomy,
                    'child_of' => $term_id,
                    'number' => 5
                ));
                foreach ($catChilds as $k => $child) :
                    $catLink = get_term_link($child, $taxonomy);
                    if ($k == 0 and $k != count($catChilds) - 1) {
                        echo "<a class='menu-item' href=\"{$catLink}\" ><span>{$child->name}</span></a>";
                    } elseif ($k == 0 and $k == count($catChilds) - 1) {
                        echo "<a class='menu-item' href=\"{$catLink}\" ><span>{$child->name}</span></a>";
                    } elseif ($k == count($catChilds) - 1) {
                        echo "<a class='menu-item' href=\"{$catLink}\"><span>{$child->name}</span></a>";
                    } else {
                        echo "<a class='menu-item' href=\"{$catLink}\"><span>{$child->name}</span></a>";
                    }
                endforeach;
                ?>
            </div>
        </div>
        <div class="full_home_sanpham">
        <?php 
        $count = 0;
        $cat_posts = new WP_Query(array(
            'post_type' => 'product',
            'showposts' => $instance["num"],
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'id',
                    'terms' => $term_id,
                )
            ),
        ));
        while ($cat_posts->have_posts()) : $cat_posts->the_post(); 
        ?>
        <div class="col-xs-6 col-md-2 <?php echo ( $count == 0) ? 'product-first' : ''; echo ( $count == 5) ? ' pdr0' : ''; ?> motsanpham">
            <?php get_template_part('template', 'product_item'); ?>  
        </div> <!-- end col-md-2 -->
        <?php
        $count++;
        endwhile;
        wp_reset_query();
        ?>
        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Form processing...
     *
     * @param array $new_instance of widget .
     * @param array $old_instance of widget .
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cat'] = $new_instance['cat'];
        $instance['num'] = $new_instance['num'];
        return $instance;
    }

    /**
     * The configuration form.
     *
     * @param array $instance of widget to display already stored value .
     * 
     */
    function form($instance) {
        ?>		
        <p>
            <label for="<?php echo $this->get_field_id("widget_title"); ?>">Tiêu đề</label>
            <input class="widefat" id="<?php echo $this->get_field_id("widget_title"); ?>" name="<?php echo $this->get_field_name("widget_title"); ?>" type="text" value="<?php echo esc_attr($instance["widget_title"]); ?>" />
        </p>
        <p>
            <label>Chuyên mục</label><br />
            <?php wp_dropdown_categories(array('name' => $this->get_field_name("cat"),'taxonomy' => 'product_category', 'hide_empty' => 0, 'selected' => $instance["cat"])); ?>
        </p>
        <p>
            <label>Số sản phẩm</label><br />
            <input class="widefat" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo intval($instance["num"]); ?>" />
        </p>
        <?php
    }

}
