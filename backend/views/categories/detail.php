<h1>Chi tiết category</h1>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $category['id']; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $category['name']; ?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($category['avatar'])): ?>
                <img src="assets/uploads/<?php echo $category['avatar'] ?>" width="60"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $category['description']; ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php
            if ($category['status'] == 0) {
                $status_text = 'Còn hàng';
            } else if ($category['status'] == 1) {
                $status_text = 'Hết hàng';
            } else if ($category['status'] == 2) {
                $status_text = 'Ngừng kinh doanh';
            }
            echo $status_text;
            ?>
        </td>
    </tr>
    <tr>
        <th>Created_at</th>
        <td>
            <?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])); ?>
        </td>
    </tr>
    <tr>
        <th>Updated_at</th>
        <td>
            <?php echo date('d-m-Y H:i:s', strtotime($category['updated_at'])); ?>
        </td>
    </tr>
</table>
<a class="btn btn-primary" href="index.php?controller=category">Back</a>

