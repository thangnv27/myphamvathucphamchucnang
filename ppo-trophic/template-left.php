<div class="widget widget_product">
    <h4 class="page-widgets">Sản phẩm nổi bật<span class="glyphicon glyphicon-list-alt"></span></h4>
    <div class="product-feature"> 
        <ul class="product_list_widget">
            <?php
            $loop = new WP_Query(array(
                'post_type' => 'product',
                'meta_query' => array(
                    array(
                        'key' => 'not_in_feature',
                        'value' => '0',
                        'compare' => '!='
                    ),
                ),
                'posts_per_page' => 4,
            ));
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <li class="item">
                    <div class="product-image">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                            <img height="80" width="80" class="img-thumbnail img-responsive" src="<?php get_image_url(); ?>" alt="<?php the_title(); ?>" />
                            <span class="product-title"><?php the_title(); ?></span>
                        </a>
                    </div>
                    <ins>
                        <span class="amount"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?>₫</span>
                    </ins>
                </li>  
                <?php
            endwhile;
            wp_reset_query();
            ?>  
        </ul>
    </div>
</div>  
<div class="widget sale_pro">
    <h4 class="page-widgets"><span class="glyphicon glyphicon-gift"></span>Sản phẩm khuyến mại</h4>
    <div class="sanphamdangkhuyenmai">
        <ul class="product_list_widget">
            <?php
            $loop = new WP_Query(array(
                'post_type' => 'product',
                'meta_query' => array(
                    array(
                        'key' => 'discount',
                        'value' => '0',
                        'compare' => '>'
                    ),
                ),
                'posts_per_page' => 4,
            ));
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <li class="item">
                    <div class="product-image">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                            <img height="80" width="80" class="img-thumbnail img-responsive" src="<?php get_image_url(); ?>" alt="<?php the_title(); ?>" />
                            <span class="product-title"><?php the_title(); ?></span>
                        </a>
                    </div>
                    <del>
                        <span class="amount"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_cu", true)), 0, ',', '.'); ?>₫</span>
                    </del>
                    <ins>
                        <span class="amount"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?>₫</span>
                    </ins>
                </li>  
                <?php
            endwhile;
            wp_reset_query();
            ?>  
        </ul>
    </div>
</div>