<?php get_header(); ?>
<div class="row baiviet">
    <?php while (have_posts()) : the_post(); ?>
    <div class="col-xs-12 col-md-9">
        <div class="conten_baiviet">
            <div class="breadcrumb">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </div>
            <div>
                <h1 itemprop="name"><strong><?php the_title() ?></strong></h1>
                <div class="luotxem">
                    <p>
                        <span class="glyphicon glyphicon-eye-open"></span>
                        <?php echo get_post_meta(get_the_ID(), "_count-views_all", true); ?> lượt xem
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-calendar"></span>
                        Ngày: <?php the_time('d-m-Y'); ?>  
                    </p>
                </div>
                <div class="post-content"><?php the_content(); ?></div>
            </div>
            <div class="post-tags">
                <?php the_tags( '<span class="glyphicon glyphicon-tags"></span> Tags: ', ', ' ); ?>
            </div>
            <div class="panel panel-default">
                <div class="binhlan"><span class="glyphicon glyphicon-user"></span>NHẬN XÉT</div>
                <div class="panel-body binhliansanp">
                    <div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="5" data-colorscheme="light"></div>               
                </div>
            </div>
            <div class="clear"></div>
            <div class="related">
                <h3 class="font20">Bài cùng chuyên mục</h3>
                <ul class="pdl0">
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'orderby' => 'rand',
                        'post__not_in' => array(get_the_ID()),
                    ));
                    while ($loop->have_posts()) : $loop->the_post();
                        ?>
                        <li>
                            <a title="<?php the_title(); ?>" rel="bookmark" href="<?php the_permalink(); ?>" style=" float:left;">
                                <img width="60" height="50" class="post_thumbnail alignleft img-thumbnail pull-left" alt="<?php the_title(); ?>" src="<?php get_image_url(true, '60x50'); ?>" />
                            </a>
                            <h2 class="title"><a title="<?php the_title(); ?>" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> <?php the_excerpt(); ?>
                        </li>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <div id="slidebar" class="col-xs-12 col-sm-3 col-md-3 filter-cost">
        <?php get_template_part('template', 'left'); ?>
    </div>
</div>
<?php get_footer(); ?>