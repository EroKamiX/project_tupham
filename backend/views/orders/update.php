

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (empty($order)): ?>
        <h2>Không tồn tại Order</h2>
    <?php else: ?>
        <h2>Chỉnh sửa danh mục #<?php echo $order['id'] ?></h2>
        <form method="post" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label>Trạng thái</label>
                <?php
                $selected_active = '';
                $selected_disabled = 'selected';
                if ($order['payment_status'] == 1) {
                    $selected_active = 'selected';
                    $selected_disabled = '';
                }
                if (isset($_POST['status'])) {
                    switch ($_POST['status']) {
                        case 0:
                            $selected_active = 'selected';
                            break;
                        case 1:
                            $selected_disabled = 'selected';
                            break;
                    }
                }
                ?>
                <select name="status" class="form-control">
                    <option value="1" <?php echo $selected_active ?> >Sold</option>
                    <option value="0" <?php echo $selected_disabled ?> >Waiting</option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
            <input type="reset" class="btn btn-secondary" name="submit" value="Reset"/>
        </form>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->

