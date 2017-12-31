<?php get_header(); ?>
<div class="row baiviet">
    <div class="col-xs-12 col-md-9">
        <div class="conten_baiviet">
            <div class="breadcrumb">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </div>
            <?php while (have_posts()) : the_post(); ?>
            <h1 class="pagetitle" itemprop="name"><?php the_title(); ?></h1>
                <div class="col-xs-12 col-sm-12 col-md-12 noidung_bai_single_cat post-content">
                    <?php  the_content();?>
                </div>
                <div class="clear"></div>
            <?php endwhile; ?>
        </div>
    </div>
    <div id="slidebar" class="col-xs-12 col-sm-3 col-md-3 filter-cost">
        <?php get_template_part('template', 'left'); ?>
    </div>
</div>

<?php get_footer(); ?>