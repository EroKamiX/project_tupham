<?php
require_once 'helpers/Helper.php';
?>
<h2>Chi tiết user</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $user['id'] ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $user['username'] ?></td>
    </tr>
    <tr>
        <th>First_name</th>
        <td><?php echo $user['first_name'] ?></td>
    </tr>
    <tr>
        <th>Last_name</th>
        <td><?php echo $user['last_name'] ?></td>
    </tr>
    <tr>
        <th>Điện thoại</th>
        <td><?php echo $user['phone'] ?></td>
    </tr>
    <tr>
        <th>Địa chỉ</th>
        <td><?php echo $user['address'] ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo $user['email'] ?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($user['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $user['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Công việc</th>
        <td><?php echo $user['jobs'] ?></td>
    </tr>
    <tr>
        <th>Lần đăng nhập cuối</th>
        <td><?php echo !empty($user['last_login']) ? date('d-m-Y H:i:s', strtotime($user['last_login'])) : '' ?></td>
    </tr>
    <tr>
        <th>Trạng thái</th>
<!--        <td>--><?php //echo Helper::getStatusText($user['status']); ?><!--</td>-->
        <td>
            <?php
            if ($category['status'] == 0) {
                $status_text = 'Active';
            } else if ($category['status'] == 1) {
                $status_text = 'Disable';
            }
            echo $status_text;
            ?>
        </td>
    </tr>
    <tr>
        <th>Ngày tạo</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($user['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Ngày sửa</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($user['updated_at'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=user&action=index" class="btn btn-primary">Back</a>