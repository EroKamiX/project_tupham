<h1>Tìm kiếm</h1>
<form action="" method="get">
    <input type="hidden" name="controller" value="category"/>
    <input type="hidden" name="action" value="index"/>
    <div class="form-group">
        <label>Nhập tên danh mục</label>
        <input type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-success"/>
        <a href="index.php?controller=category" class="btn btn-secondary">Xóa filter</a>
    </div>
</form>

<h1><center>Danh sách loại mặt hàng</center></h1>
<a href="index.php?controller=category&action=create" class="btn btn-primary">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Tên mặt hàng</th>
        <th>Ảnh</th>
        <th>Mô tả</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
        <th>Ngày sửa</th>
        <th></th>
    </tr>
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td>
                    <?php echo $category['id']; ?>
                </td>
                <td>
                    <?php echo $category['name']; ?>
                </td>
                <td>
                    <?php if (!empty($category['avatar'])): ?>
                        <img src="assets/uploads/<?php echo $category['avatar'] ?>" width="60"/>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $category['description']; ?>
                </td>
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
                <td>
                    <?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])); ?>
                </td>
                <td>
                    <?php
                    if (!empty($category['updated_at'])) {
                        echo date('d-m-Y H:i:s', strtotime($category['updated_at']));
                    }
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=category&action=detail&id=<?php echo $category['id'] ?>"
                       title="Chi tiết">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="index.php?controller=category&action=update&id=<?php echo $category['id'] ?>" title="Sửa">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <a href="index.php?controller=category&action=delete&id=<?php echo $category['id'] ?>" title="Xóa"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="7"><?php echo $pages; ?></td>
        </tr>

    <?php else: ?>
        <tr>
            <td colspan="7">Không có bản ghi nào</td>
        </tr>
    <?php endif; ?>
</table>
