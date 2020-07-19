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
            <h6 class="m-0 font-weight-bold text-primary">Order Detail</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Title</th>
                        <th>Quality</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($orders)) :?>
                        <tr>
                            <td colspan="4">Không có bản ghi nào</td>
                        </tr>
                    <?php else:?>
                        <?php foreach ($orders AS $order) :?>
                            <tr>
                                <td><?php echo $order['order_id'] ?></td>
                                <td><?php echo $order['product_title'] ?></td>
                                <td><?php echo $order['quality'] ?></td>
                                <td>
                                    <?php
                                    if ($order['status'] ==0 ) {
                                        echo "Wating";
                                    }
                                    else {
                                        echo "sold";
                                    }
                                    ?>
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
