<div class="row module_newfooter">
        <div class="col-xs-12 col-md-8">
            <div class="row">
                <h4 class="tieudenewsf">
                    <?php
                    $newshome = get_option(SHORT_NAME . "_news");
                    $categorynews = get_category($newshome);
                    ?>
                    <a href="<?php echo get_category_link($newshome); ?>" title="<?php echo $categorynews->name; ?>"><span class="glyphicon glyphicon-credit-card"></span><?php echo $categorynews->name; ?></a>
                    <a href="<?php echo get_category_link($newshome); ?>" title="<?php echo $categorynews->name; ?>" class="title_link_no" rel="bookmark"><span class="glyphicon glyphicon-forward"></span>Xem tất cả</a>
                </h4>
                 <?php
                    $count = 1;
                    $argsN = array(
                        'post_type' => 'post',
                        'cat' => $newshome,
                        'posts_per_page' => 4
                    );
                    $queryN = new WP_Query($argsN);
                    while ($queryN->have_posts()) : $queryN->the_post();
                    if($count == 1){
                    ?>
                <div class="col-xs-12 col-md-5 content-news">

                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                        <img width="308" height="150" class="img-thumbnail" alt="<?php the_title(); ?>" src="<?php get_image_url(); ?>"></a>
                    <div class="luotxem">
                        <p>
                            <span class="glyphicon glyphicon-eye-open"></span>
                            <?php echo get_post_meta(get_the_ID(), "_count-views_all", true); ?> lượt xem</p>
                        <p>
                            <span class="glyphicon glyphicon-calendar"></span>
                            Ngày: <?php the_time('d-m-Y'); ?>
                        </p>
                    </div>
                    <h2><small><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></small></h2>
                    <p><?php the_excerpt(); ?></p>
                </div>
                    <?php }elseif($count == 2){ ?>
                    <div class="col-xs-12 col-md-7 benphainhe">  <!-- end col-md-5 -->
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                            <img width="120" height="100" class="img-thumbnail" alt="<?php the_title(); ?>" src="<?php get_image_url(); ?>"></a>
                        <h2><small><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></small></h2>
                        <p><?php the_excerpt(); ?></p>
                        <div class="luotxem">
                            <p>
                                <span class="glyphicon glyphicon-eye-open"></span>
                                <?php echo get_post_meta(get_the_ID(), "_count-views_all", true); ?> lượt xem</p>
                            <p>
                                <span class="glyphicon glyphicon-calendar"></span>
                                Ngày viết : <?php the_time('d-m-Y'); ?> 
                            </p>
                        </div> 
                    <?php }else{ ?>
                        <h3><small><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><span class="glyphicon glyphicon-file"></span><?php the_title(); ?></a></small></h3>
                        <?php the_excerpt(); ?>
                <?php
                    }
                    $count++; 
                    if($count == $queryN->found_posts + 1){echo "</div>";}
                    endwhile;
                    wp_reset_query();
                ?>
            </div>
        </div><!-- end col-md-8 -->
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-xs-12 col-md-12 hotroonline">
                    <p class="tieude"><span class="glyphicon glyphicon-question-sign"></span>Hỡ trợ khách hàng</p>
                    <div class="alert info_thongtin">
                        <p>
                            <span class="glyphicon glyphicon-earphone"></span>
                            Hotline : <strong><?php echo get_option('info_tel'); ?> </strong><br />
                            <i>(<?php echo get_option('info_timework') ?>)</i>
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-envelope"></span>
                            <a href="mailto:<?php echo get_option('info_email'); ?> " rel="nofollow" title="send email" class="fl mt5"><?php echo get_option('info_email'); ?></a>
                        </p>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="row">
                <div class="alert email_khuyenmai">
                    <p class="email_la_email"><span class="glyphicon glyphicon-gift"></span>Đămg ký nhận thông tin khuyến mại</p>
                    <div>
                        <div class="eemail_caption">
                            Đăng ký để nhận, khuyến mãi độc quyền, giao dịch, phiếu giảm giá,  tin tức và hơn thế nữa!  
                        </div>
                        <?php es_subbox( $namefield = "YES", $desc = "", $group = "" ); ?>
                    </div>  
                </div><!-- end alert -->
            </div><!-- end row -->
        </div><!-- end col-md-4 -->
</div>