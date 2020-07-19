<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="../backend/assets/uploads/<?php echo $product['avatar'] ?>" alt="">
                        </div>
                        <h2 class="summary" style="height: 50px"><a href="index.php?controller=product&action=detail&id=<?php echo $product['id']?>"><?php echo $product['title'] ?></a></h2>
                        <div class="product-carousel-price">
                            <ins><?php echo number_format($product['price']) ?>
                        </div>

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70"
                               rel="nofollow" href="them-vao-gio-hang/<?php echo $product['id']?>">Add to cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <nav aria-label="Page navigation example">
            <?php echo $pages; ?>
        </nav>
    </div>