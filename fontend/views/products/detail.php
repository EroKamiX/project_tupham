

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


            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="">Home</a>
                        <a href="">Category Name</a>
                        <a href="index.php?controller=product&action=detail&id=<?php echo $product['id'] ?>"><?php echo $product['title'] ?></a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="../backend/assets/uploads/<?php echo $product['avatar'] ?>" alt="">
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?php echo $product['title'] ?></h2>
                                <div class="product-inner-price">
                                    <ins><?php echo number_format($product['price']) ?></ins>
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1"
                                               name="quantity" min="1" step="1">
                                    </div>
                                    <a class="add_to_cart_button" href="them-vao-gio-hang/<?php echo $product['id'] ?>">Add
                                        to cart</a>
                                </form>


                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                                                  role="tab" data-toggle="tab">Description</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#home1" aria-controls="home1"
                                                                                  role="tab" data-toggle="tab">Specification</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Description</h2>
                                            <p><?php echo $product['content'] ?></p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="home1">
                                            <h2>Specification</h2>
                                            <p><?php echo $product['content'] ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>