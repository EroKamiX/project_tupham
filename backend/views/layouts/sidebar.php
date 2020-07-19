<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="assets/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name"><?php echo $_SESSION['user']['username'];?></p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?controller=category&action=index">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Quản lý loại mặt hàng</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?controller=product&action=index">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Quản lý sản phẩm</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?controller=user&action=index">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Quản lý users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?controller=order&action=index">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Order</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?controller=orderdetail&action=index">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Order Detail</span>
            </a>
        </li>
    </ul>
</nav>