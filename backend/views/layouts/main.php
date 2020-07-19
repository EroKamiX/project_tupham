<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once 'navbar.php' ?>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require_once 'sidebar.php' ?>
        <!-- partial -->

        <div class="main-panel">
            <div class="message-wrap content-wrap content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($this->error)): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $this->error;
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php endif; ?>
                </section>
            </div>

            <div class="content-wrapper">
                <section class="content">
                    <?php echo $this->content; ?>
                </section>
            </div>

            <!-- partial:partials/_footer.html -->
            <?php require_once 'footer.php' ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/js/jquery.min.js" ></script>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="assets/js/shared/off-canvas.js"></script>
<script src="assets/js/shared/misc.js"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="assets/js/demo_1/dashboard.js"></script>
<!-- End custom js for this page-->

<!-- Bootstrap 3.3.7 -->
<script src="assets/js/bootstrap.min.js"></script>

<!--CKEditor -->
<script src="assets/ckeditor/ckeditor.js"></script>
<!--My Scrip-->
<script src=""></script>
</body>
</html>