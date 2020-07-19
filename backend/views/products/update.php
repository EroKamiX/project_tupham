<h2>Thêm mới sản phẩm</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_id">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php foreach ($categories as $category):
                $selected = $product['category_id'];
                if (isset($_POST['category_id']) && $category['id'] == $_POST['category_id']) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Nhập tên sản phẩm</label>
        <input type="text" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : $product['title'] ?>"
               class="form-control" id="title"/>
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar"/>
        <?php if (!empty($product['avatar'])): ?>
            <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="price">Giá</label>
        <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : $product['price'] ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn sản phẩm</label>
        <textarea name="summary" id="summary"
                  class="form-control" rows="5"><?php echo isset($_POST['summary']) ? $_POST['summary'] : $product['summary'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="description">Mô tả chi tiết sản phẩm</label>
        <textarea name="content" id="description"
                  class="form-control" rows="10"><?php echo isset($_POST['content']) ? $_POST['content'] : $product['content'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" id="status">
            <?php
            $selected_stocking = '';
            $selected_outstock = '';
            $selected_stop = '';
            if ($product['status'] == 0) {
                $selected_disabled = 'selected';
            } else {
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
            <option value="0" <?php echo $selected_stocking ?> >Còn hàng</option>
            <option value="1" <?php echo $selected_outstock ?> >Hết hàng</option>
            <option value="2" <?php echo $selected_stop ?> >Ngừng kinh doanh</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=product&action=index" class="btn btn-default">Back</a>
    </div>
</form>