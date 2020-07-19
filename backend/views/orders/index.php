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
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Full name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Note</th>
                        <th>Price Total</th>
                        <th>Payment Status</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($orders)) :?>
                        <tr>
                            <td colspan="12">Không có bản ghi nào</td>
                        </tr>
                    <?php else:?>
                        <?php foreach ($orders AS $order) :?>
                            <tr>
                                <td><?php echo $order['id'] ?></td>
                                <td><?php echo $order['user_name'] ?></td>
                                <td><?php echo $order['fullname'] ?></td>
                                <td><?php echo $order['address'] ?></td>
                                <td><?php echo $order['mobile'] ?></td>
                                <td><?php echo $order['email'] ?></td>
                                <td><?php echo $order['note'] ?></td>
                                <td><?php echo number_format($order['price_total']) ?></td>
                                <!--                    <td>--><?php //echo Helper::getStatusText($product['status']) ?><!--</td>-->


                                <td>
                                    <?php
                                    $status_text = 'Sold';
                                    if ($order['payment_status'] == 0) {
                                        $status_text = 'Waiting';
                                    }
                                    echo $status_text;
                                    ?>
                                </td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></td>
                                <td><?php echo !empty($order['updated_at']) ? date('d-m-Y H:i:s', strtotime($order['updated_at'])) : '--' ?></td>
                                <td>
                                    <?php
                                    $url_detail = "index.php?controller=order&action=detail&id=" . $order['id'];
                                    $url_update = "index.php?controller=order&action=update&id=" . $order['id'];
                                    $url_delete = "index.php?controller=order&action=delete&id=" . $order['id'];
                                    ?>
                                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>


                        <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->
