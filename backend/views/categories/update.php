<?php if (empty($category)): ?>
    <h2>Không tồn tại category</h2>
<?php else: ?>
    <h2>Chỉnh sửa danh mục #<?php echo $category['id'] ?></h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" name="name"
                   value="<?php echo isset($_POST['name']) ? $_POST['name'] : $category['name']; ?>"
                   class="form-control"/>
        </div>

        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control"/>
        </div>
        <?php if (!empty($category['avatar'])): ?>
            <img src="assets/uploads/<?php echo $category['avatar']; ?>" height="50"/>
        <?php endif; ?>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control"
                      name="description" rows="10"><?php echo isset($_POST['description']) ? $_POST['description'] : $category['description']; ?></textarea>
        </div>

        <div class="form-group">
            <?php
            $selected_stocking = '';
            $selected_outstock = '';
            $selected_stop = '';
            if ($category['status'] == 1) {
                $selected_active = 'selected';
            }
            if (isset($_POST['status'])) {
                switch ($_POST['status']) {
                    case 0:
                        $selected_stocking = 'selected';
                        break;
                    case 1:
                        $selected_outstock = 'selected';
                        break;
                    case 2:
                        $selected_stop = 'selected';
                        break;
                }
            }
            ?>
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" <?php echo $selected_stocking ?> >Còn hàng</option>
                <option value="1" <?php echo $selected_outstock ?> >Hết hàng</option>
                <option value="2" <?php echo $selected_stop ?> >Ngừng kinh doanh</option>
            </select>
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
        <input type="reset" class="btn btn-secondary" name="submit" value="Reset"/>
    </form>
<?php endif; ?>