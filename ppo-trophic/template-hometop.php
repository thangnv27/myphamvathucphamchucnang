<div style="background:none; padding:0" class="main_menu_header">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 home_slider">
            <div style="border:none; margin:0; padding:0" class="thumbnail">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('homepagesidebar')) : ?><?php endif; ?>
            </div>
        </div> <!-- col-xs-12 .col-sm-3 col-md-6 -->
        <!--<div class="col-xs-12 col-sm-2 col-md-3 quangcao">
            <?php //echo stripslashes(get_option('banner_home')); ?>
        </div> <!-- end col-md-6 -->
    </div>
</div>