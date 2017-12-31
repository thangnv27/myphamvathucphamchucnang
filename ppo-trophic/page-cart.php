<?php
/*
  Template Name: Page Gio hang
 */
get_header();
?>
<div id="content" role="main" class="content">
    <div class="breadcrumb">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <?php
        if (empty($_SESSION['cart'])) {
            echo "<div class='cart-empty'>Giỏ hàng chưa có sản phẩm nào!!!"
            . "<br>Hãy chọn những sản phẩm mà bạn yêu thích để thêm vào giỏ hàng"
            . "</div>";
        } else {
    ?>
    <div class="cartInfo">
        <table>
            <thead>
                <tr style="height: 38px;">
                    <th style="width: 200px;">Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th style="width: 50px;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['cart']) and ! empty($_SESSION['cart'])):
                    $cart = $_SESSION['cart'];
                    $maxQuantity = get_option(SHORT_NAME . '_maxQuantity');
                    if ($maxQuantity == "")
                        $maxQuantity = 10;
                    $totalAmount = 0;
                    foreach ($cart as $product) :
                        $totalAmount += $product['amount'];
                        $product_id = $product['id'];
                        $permalink = get_permalink($product_id);
                        $title = get_the_title($product_id);
                        ?>
                        <tr id="product_item_<?php echo $product_id; ?>">
                            <td class="thumb">
                                <a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>">
                                    <img width="200px" src="<?php echo $product['thumb']; ?>" alt="<?php echo $title; ?>" />
                                </a>
                            </td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</td>
                            <td class="quantity">
                                <select name="quantity[<?php echo $product_id; ?>]" onchange="AjaxCart.updateItem(<?php echo $product_id; ?>, this.value)" style="width: 50px;">
                                    <?php
                                    for ($i = 1; $i <= $maxQuantity; $i++) {
                                        if ($i == $product['quantity'])
                                            echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
                                        else
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><span class="product-subtotal"><?php echo number_format($product['amount'], 0, ',', '.'); ?> đ</span></td>
                            <td class="delete"><a href="#" onclick="if (confirm('Bạn có chắc chắn muốn xoá không?')) {
                                        AjaxCart.deleteItem(<?php echo $product_id; ?>);
                                    }
                                    return false;" title="Delete"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/btnDel.png"/></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <div class="cart-price mt10">
        <span>Tổng tiền: </span> <span class="total_price t_red"><?php echo number_format($totalAmount, 0, ',', '.'); ?> đ</span>
    </div>
    <div class="btnCart">
        <a href="<?php echo home_url(); ?>">Tiếp tục mua hàng</a>
        <a href="javascript://" onclick="AjaxCart.preCheckout();">Thanh toán</a>
    </div>
    <?php }?>
</div><!-- #content -->
<?php get_footer(); ?>