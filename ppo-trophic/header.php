<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="author" content="ppo.vn" />
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />
        <meta property="fb:app_id" content="<?php echo get_option(SHORT_NAME . "_appFBID"); ?>" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />        
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap-theme.css" rel="stylesheet" />
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/dlmenu.css"/>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.fancybox.css" />
        <?php if(is_page(get_option(SHORT_NAME . "_pageHistoryOrder"))): ?>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/colorbox/colorbox.css" />
        <?php endif; ?>
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/common.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/wp-default.css" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" /> 
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var siteUrl = "<?php bloginfo('siteurl'); ?>";
            var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
            var no_image_src = themeUrl + "/images/no_image_available.jpg";
            var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
            var cartUrl = "<?php echo get_page_link(get_option(SHORT_NAME . "_pageCartID")); ?>";
            var checkoutUrl = "<?php echo get_page_link(get_option(SHORT_NAME . "_pageCheckoutID")); ?>";
            var lang = "<?php echo getLocale(); ?>";
        </script>
        <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/modernizr.js"></script>
        <?php
        if (is_singular())
            wp_enqueue_script('comment-reply');

        wp_head();
        ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="ajax_loading" style="display: none;z-index: 99999" class="ajax-loading-block-window">
            <div class="loading-image"></div>
        </div>
        <!--Alert Message-->
        <div id="nNote" class="nNote" style="display: none;"></div>
        <!--END: Alert Message-->
        <div class="main-header container">
            <div class="top-menu pdt5">
                <div class="left-user">
                    <p style="float:right; padding:5px; margin:5px; border-radius:5px" class="label  label-danger">
                        <a title="Xem giỏ hàng" href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageCartID")); ?>" style="color:#FFF" class="cart-contents">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            Giỏ hàng (<span class="cart-count"><?php
                            if (isset($_SESSION['cart']) and ! empty($_SESSION['cart'])) {
                                $cart = $_SESSION['cart'];
                                echo count($cart);
                            } else {
                                echo "0";
                            }
                            ?></span>)</a>
                    </p>
                    <ul class="menu-user">
                        <?php if (is_user_logged_in()): ?>
                            <li class="money-back">
                                <a href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageHistoryOrder")); ?>" title="Lịch sử mua hàng">Lịch sử mua hàng</a>
                            </li>
                        <?php
                        endif;
                        
                        $discountPage = get_option(SHORT_NAME . "_discountID");
                        $cartPage = get_option(SHORT_NAME . "_cart");
                        ?>
                        <li class="hidden-xs">
                            <a title="Chính sách giảm giá" href="<?php echo get_page_link($discountPage); ?>">Chính sách giảm giá</a>
                        </li>
                        <li class="hidden-xs">
                            <a title="Hướng dẫn mua hàng" href="<?php echo get_page_link($cartPage); ?>">Hướng dẫn mua hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb10">
                <div class="col-xs-6 col-sm-5 col-md-3 logo-header">
                    <a title="<?php bloginfo('sitename'); ?>" itemprop="url" href="<?php bloginfo('siteurl'); ?>">
                        <img class="logo" title="<?php bloginfo('sitename'); ?>" alt="<?php bloginfo('sitename'); ?>" src="<?php echo get_option('sitelogo'); ?>" itemprop="logo" />
                    </a>
                </div>  <!-- end col-xs-12 col-sm-6 col-md-3 -->
                <div class="col-xs-6 col-sm-7 col-md-9">
                    <div class="row header-user">
                        <div class="col-sm-12 col-md-8">
                            <div class="col-xs-12 col-sm-6 col-md-4"> 
                                <div class="coler-desc">
                                    <div class="coler-icon_pro"><span class="glyphicon glyphicon-refresh"></span></div>
                                    <div class="coler-mesting">Thanh toán khi nhận hàng</div>
                                </div> 
                            </div> 
                            <div class="col-sm-6 col-md-4"> 
                                <div class="coler-desc">
                                    <div class="coler-icon_pro"><span class="glyphicon glyphicon-plane"></span></div>
                                    <div class="coler-mesting">Giao hàng toàn quốc</div>
                                </div> 
                            </div>  
                            <div class="col-sm-6 col-md-4">
                                <div class="coler-desc">
                                    <div class="coler-icon_pro"><span class="glyphicon glyphicon-home"></span></div>
                                    <div class="coler-mesting">Đổi trả hàng trong 7 ngày</div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="hotline coler-desc">
                                <div class="coler-icon"><span class="glyphicon glyphicon-phone-alt"></span></div>
                                <div class="coler-mest">Hotline <span>24/7</span>
                                    <p class="sdt"><?php echo get_option(SHORT_NAME . "_hotline"); ?></p>                               
                                </div>
                            </div>
                        </div>    
                    </div>
                    <nav id="navigation">
                        <?php
                        wp_nav_menu(array(
                            'container' => '',
                            'theme_location' => 'primary',
                            'menu_class' => 'fancy-rollovers wf-mobile-hidden',
                            'menu_id' => 'main-nav',
                        ));
                        ?>
                        <a href="javascript://" rel="nofollow" id="mobile-menu">
                            <span class="menu-open">DANH MỤC</span>
                            <span class="menu-close">ĐÓNG</span>
                            <span class="menu-back">QUAY LẠI</span>
                            <span class="wf-phone-visible">&nbsp;</span>
                        </a>
                        <div class="clearfix"></div>
                    </nav>
                <div class="clearfix"></div>
                </div>
            </div> 
        </div> <!-- row-->

    </div>
    <div class="container">
        <div class="main_menu_header">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 side-cat-menu">
                    <div class="cat-menu-title">
                        <p class="danhmucmenu">Danh mục sản phẩm</p>
                    </div>
                    <div class="menu-cat">
                        <?php wp_nav_menu(array("theme_location" => "mega_main_sidebar_menu")); ?>
                    </div>
                </div> <!-- side-cat-menu -->
                <div class="col-xs-12 col-sm-6 col-md-6 header-search">
                    <div class="row">
                        <form action="<?php echo home_url(); ?>" id="searchform" role="search">   
                            <div class="col-xs-8 col-sm-8 col-md-10">
                                <input type="text" placeholder="Tìm kiếm theo sản phẩm, danh mục hay nhãn hàng mong muốn" name="s" value="" class="form-control" />
                            </div> 
                            <div class="col-xs-4 col-sm-4 col-md-2 pdl0">
                                <button class="btn btn-default tim_but" type="submit"><span class="glyphicon glyphicon-search"></span>Tìm kiếm</button> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-3 header-ads">
                    <div class="user-link row">
                        <?php
                        $news = get_option(SHORT_NAME . "_news");
                        $saleoff = get_option(SHORT_NAME . "_saleoff");
                        ?>
                        <a title="tin tức" href="<?php echo get_category_link($news); ?>" style="font-size:20px" class="linhhover">
                            <span class="label label-success">Tin tức</span>
                        </a>
                        <a title="Khuyến mại" href="<?php echo get_category_link($saleoff); ?>" style="font-size:20px" class="linhhover">
                            <span class="label label-danger">Khuyến mại</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
