
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form method="post" action="">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //tổng giá trị đơn hàng
                                $total_order = 0;
                                ?>

                                <?php foreach ($_SESSION['cart'] AS $product_id => $product): ?>
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <a title="Remove this item" class="remove"
                                               href="xoa-san-pham/<?php echo $product_id ?>">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="#"><img width="145" height="145" alt="poster_1_up"
                                                             class="shop_thumbnail"
                                                             src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="#"><?php echo $product['name'] ?></a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount"><?php echo number_format($product['price']) ?></span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <input type="number" name="<?php echo $product_id ?>" size="4"
                                                       class="input-text qty text" title="Qty"
                                                       value="<?php echo $product['quality']; ?>" min="0" step="1">
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                        <span class="amount"><?php
                                            //hiển thị Thành tiền tương ứng với từng sp
                                            $total_product = $product['quality'] * $product['price'];
                                            //cộng dồn vào biến Tổng giá trị đơn hàng
                                            $total_order += $total_product;
                                            echo number_format($total_product);
                                            ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td class="actions" colspan="5">

                                        <input type="submit" value="Update Cart" name="update_cart"
                                               class="btn btn-primary">
                                        <a href="thanh-toan" class="button btn btn-success">Payment</a>
                                    </td>
                                    <td colspan="1" style="text-align: right">
                                        Tổng giá trị đơn hàng:
                                        <span class="product-price">
                                            <?php echo number_format($total_order) ?>
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>