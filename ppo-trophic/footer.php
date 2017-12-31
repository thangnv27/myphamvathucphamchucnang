<?php get_template_part('template', 'user'); ?>
<?php get_template_part('template', 'news'); ?>  

</div>
<div id="footer">
    <div class="container">
        <div class="main-footer row">
            <div class="col-xs-6 col-md-3 cotfooter">
                <p class="widgettitlefooter">THÔNG TIN LIÊN HỆ</p>
                <p class="congty"><?php echo get_option('unit_owner'); ?></p>
                <p><span class="glyphicon glyphicon-home"></span> Địa chỉ: <?php echo get_option('info_address'); ?></p>
                <p><span class="glyphicon glyphicon-phone-alt"></span>Điện thoại: <b> <?php echo get_option("info_tel"); ?></b></p>
                <p><span class="glyphicon glyphicon-envelope"></span>Email: <?php echo get_option('info_email'); ?></p>
            </div>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footersidebar') ) : ?><?php endif; ?>
        </div><!-- end row -->
    </div>
</div>
<div id="banquyen" class="container t_center">
    <span class="font12">Copyright &copy; <a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo('sitename'); ?></a>. All rights reserved. Thiết kế bởi <a href="http://ppo.vn" title="Thiết kế web chuyên nghiệp">PPO.VN</a></span>
</div>
<!--end Footer-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-migrate.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.fancybox.pack.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.easing-1.3.pack.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.mousewheel-3.0.4.pack.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.resmenu.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.dlmenu.js"></script>
<?php if(is_page(get_option(SHORT_NAME . "_pageHistoryOrder"))): ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/colorbox/jquery.colorbox-min.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>

<?php wp_footer(); ?>
</body>
</html>