<div class="module_tintuc_khachhang">
    <h4 class="tieudenewsf">
        <?php
        $categoryhome = get_option(SHORT_NAME . "_categoryhome");
        $categoryuser = get_category($categoryhome);
        ?>
        <a href="<?php echo get_category_link($categoryhome); ?>" title="<?php echo $categoryuser->name; ?>"><span class="glyphicon glyphicon-credit-card"></span> Cẩm nang mua sắm</a>
        <a href="<?php echo get_category_link($categoryhome); ?>" title="<?php echo $categoryuser->name; ?>" class="title_link_no" rel="bookmark"><span class="glyphicon glyphicon-forward"></span>Xem tất cả</a>
    </h4>
    <div class="row">
        <?php
        $argsG = array(
            'post_type' => 'post',
            'cat' => $categoryhome,
            'posts_per_page' => 4
        );
        $queryG = new WP_Query($argsG);
            while ($queryG->have_posts()) : $queryG->the_post();
            ?>
            <div class="col-xs-6 col-md-3 tintuchome">
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="bookmark">
                    <img width="275" height="150" class="img-thumbnail" alt="<?php the_title(); ?>" src="<?php get_image_url(); ?>" />
                </a>
                <h3><small><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></small></h3>
                <div class="channewh3"><small></small></div>
            </div> 
        <?php
            endwhile;
            wp_reset_query();
        ?>
    </div> <!-- end row -->
</div>