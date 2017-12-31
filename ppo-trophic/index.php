<?php get_header(); ?>
<?php get_template_part('template', 'hometop'); ?>
<div class="row module_sanpham">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('homemainsidebar')) : ?><?php endif; ?>
</div>
<?php get_footer(); ?>
