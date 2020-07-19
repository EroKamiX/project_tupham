
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Payment</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
<div class="container">
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h5 class="center-align">Thông tin khách hàng</h5>
                <div class="form-group">
                    <label>Họ tên khách hàng</label>
                    <input type="text" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>"  class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''?>"  class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>SĐT</label>
                    <input type="number" min="0" name="mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : '' ?>"  class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" min="0" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"  class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Ghi chú thêm</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h5 class="center-align">Thông tin đơn hàng của bạn</h5>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th width="40%">Tên sản phẩm</th>
                        <th width="12%">Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php  $total_order = 0;
                            $cart = [];

                            if (!empty($product_buy)) {
                                $cart = $product_buy;
                            }
                            else {
                                $cart = $_SESSION['cart'];
                            }
                    ?>
                    <?php foreach ($cart AS $product_id => $product):?>
                        <tr>
                            <td>
                                <img class="product-avatar img-responsive" src="../backend/assets/uploads/<?php echo $product['avatar']?>"
                                     width="80">
                                <div class="content-product">
                                    <a href="chi-tiet-san-pham/<?php echo $product_id?>" class="content-product-a">
                                        <?php echo $product['name']?> </a>
                                </div>
                            </td>
                            <td>
                                <?php echo $product['quality']?>
                            </td>
                            <td>
                                <?php echo number_format($product['price']) ?>đ
                            </td>
                            <td>
                                <?php
                                $total_price = $product['quality']* $product['price'];
                                $total_order += $total_price;
                                echo number_format($total_price);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <td colspan="5">
                            <span class="product-price"><?php echo number_format($total_order)?></span>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <input type="submit" name="submit" value="Payment" class="btn btn-primary">
                <a href="gio-hang-cua-ban" class="btn btn-secondary">Cart</a>
            </div>
        </div>
    </form>
</div>
</div>