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