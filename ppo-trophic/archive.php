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
            <h1 class="pagetitle"><?php single_cat_title(); ?></h1>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-xs-12 col-sm-12 col-md-12 noidung_bai_single_cat">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><img width="275" height="150" class="img-thumbnail alignleft pull-left" alt="<?php the_title(); ?>" src="<?php get_image_url(); ?>"/></a>
                        </div> <!-- col-xs-12 col-sm-4 col-md-3 -->
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="text-content-news">
                                <h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="luotxem">
                                    <p>
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        <?php echo get_post_meta(get_the_ID(), "_count-views_all", true); ?> lượt xem</p>
                                    <p>
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        Ngày: <?php the_time('d-m-Y'); ?> 
                                    </p>
                                </div>
                                <p><?php the_excerpt(); ?></p>
                                <h6 class="label label-danger"><a title="<?php the_title(); ?>" rel="bookmark" href="<?php the_permalink(); ?>" style="color:#FFF"> Xem tiếp</a></h6>
                            </div><!--end text-content-news-->
                        </div> <!-- col-xs-12 col-sm-8 col-md-8 -->
                    </div><!--end row-->  
                </div>
                <div class="clear"></div>
            <?php endwhile; ?>
            <?php getpagenavi();?>
        </div>
    </div>
    <div id="slidebar" class="col-xs-12 col-sm-3 col-md-3 filter-cost">
        <?php get_template_part('template', 'left'); ?>
    </div>
</div>
<?php get_footer(); ?>