<?php get_header(); ?>
<div class="row cat_sanpham">
    <div class="col-xs-12 col-md-3 filter-cost" id="slidebar">
        <?php get_template_part('template', 'left'); ?>  
    </div>
    <div class="col-xs-12 col-md-9" style="margin:10px 0">
        <div id="content" role="main">
            <div class="breadcrumb">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </div>
            <h1 class="catproduc-title">
                <span class="glyphicon glyphicon-tasks"></span>
                <?php single_cat_title(); ?>
            </h1>
            <div class="term-description"><p><?php echo category_description();?></p></div>
            <div class="navbar" style="max-height:70px; margin-bottom:0"></div>
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>
                <div class="col-xs-6 col-md-3 motsanpham">
                    <?php get_template_part('template', 'product_item'); ?>  
                </div>
                <?php endwhile;?>  
                <?php getpagenavi();?> 
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>