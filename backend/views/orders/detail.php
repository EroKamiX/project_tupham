
<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 2/29/2020
 * Time: 3:36 PM
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order</h6>
            <div style="text-align: right">
                <button  class="btn btn-danger"><a style="color: white" href="index.php?controller=order&action=delete">Xóa</a></button>
                <button  class="btn btn-success"><a style="color: white" href="index.php?controller=order&action=update">Sửa</a></button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>Tên Tài Khoản</th>
                        <td><?php echo $order['user_name']?></td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td><?php echo $order['fullname']?></td>
                    </tr><tr>
                        <th>Address</th>
                        <td><?php echo $order['address']?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $order['email']?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td><?php echo $order['mobile']?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                            $status_text = 'Sold';
                            if ($order['payment_status'] == 0) {
                                $status_text = 'Waiting';
                            }
                            echo $status_text;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Created_at</th>
                        <td>
                            <?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Updated_at</th>
                        <td>
                            <?php if (isset ($order['update_at'])) {
                                echo date("d-m-Y H:i:s",strtotime($order['update_at']));
                            }
                            else {
                                echo "<span style='color:limegreen;'>Chưa Update lần nào</span>";
                            } ?>
                        </td>
                    </tr>
                </table>
                <button class="btn btn-primary"><a style="color: white" href="index.php?controller=">Back</a></button>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->


