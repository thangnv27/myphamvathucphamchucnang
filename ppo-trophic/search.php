<?php get_header(); ?>
<div class="row cat_sanpham">
    <div class="col-xs-12 col-md-3 filter-cost" id="slidebar">
        <?php get_template_part('template', 'left'); ?>
    </div>
    <div class="col-xs-12 col-md-9" style="margin:10px 0">
        <div id="content" role="main">
            <h1 class="catproduc-title">
                <span class="glyphicon glyphicon-tasks"></span>
                Kết quả tìm kiếm: "<?php the_search_query(); ?>"
            </h1>
            <div class="navbar" style="max-height:70px; margin-bottom:0"></div>
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>
                <div class="col-xs-6 col-md-3 motsanpham">
                    <div class="short-product">
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" style="border:none; box-shadow:none" class="thumbnail">
                            <img class="img-rounded" alt="<?php the_title(); ?>" src="<?php get_image_url(); ?>" />
                        </a>
                        <div class="caption">
                            <h2><a itemprop="name" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                            <div class="post-price">
                                <div class="price">
                                    <span class="amount" itemprop="price"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> ₫</span>          
                                </div>
                                <!--<div class="salepercent"></div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
                <?php getpagenavi();?> 
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>