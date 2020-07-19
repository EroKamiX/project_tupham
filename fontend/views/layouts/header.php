<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <h1><a href="./"><img src="assets/img/logo.png"></a></h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-search">

                        <div class="" style="border: none;">
                            <form action="index.php?action=filter" method="get">
                                <input type="text" placeholder="Search ..." name="title" class="form-control" style="height: auto; width: 80%;display: inline-block">
                                <button type="submit" name="search" class="btn"><i class="fa fa-search"></i>
                                </button>
                            </form>
<!--                            <form action="index.php?action=search" method="post" class="form-inline">-->
<!--                                <div class="form-group">-->
<!--                                    -->
<!--                                    <input type="text" class="" id="search" placeholder="Search ...">-->
<!--                                </div>-->
<!--                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>-->
<!--                            </form>-->
                        </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="shopping-item">
                    <a href="gio-hang-cua-ban">Cart<i class="fa fa-shopping-cart"></i> <span
                                class="product-count"><?php echo isset($_SESSION['cart']) ? "(" . count($_SESSION['cart']) . ")" : '' ?></span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->
<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <!--            <div class="navbar-header">-->
            <!--
            <!--            </div>-->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php echo (!isset($_GET['controller']) || $_GET['controller'] == 'Product') && ($_GET['action'] == 'index' || !isset($_GET['action'])) ? 'active' : '' ?>">

                        <a href="index.php">Home</a>
                    </li>
                    <?php if (isset($categories)) : ?>
                        <?php foreach ($categories AS $category): ?>
                            <?php
                            $is_active = '';
                            if (isset($_GET['category_id'])) {
                                if ($_GET['category_id'] == $category['id']) {
                                    $is_active = "active";
                                }
                            }
                            ?>
                            <li class="<?php echo $is_active ?>"><a
                                        href="index.php?controller=Product&action=filter&category_id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <li class="<?php echo (isset($_GET['controller']) && $_GET['controller'] == 'Cart') ? 'active' : '' ?>">
                        <a href="index.php?controller=Cart">Cart</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End mainmenu area -->