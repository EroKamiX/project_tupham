<?php
require_once 'models/Model.php';

class Category extends Model
{
    public $id;
    public $name;
    public $avatar;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    public $query_params = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $name = $_GET['name'];
            $name = addslashes($name);
            $this->query_params .= " AND `name` LIKE '%$name%'";
        }
    }

    /**
     * Lấy toàn bộ các bản ghi dựa theo mảng param truyền vào - không có phân trang
     */
    public function getAll($params = [])
    {
        $obj_select = $this->connection->prepare("SELECT * FROM categories WHERE TRUE $this->query_params");

        $obj_select->execute();
        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    /**
     * Lấy toàn bộ các bản ghi dựa theo mảng param truyền vào - có phân trang
     */
    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM categories WHERE TRUE $this->query_params LIMIT $start, $limit");
        $obj_select->execute();
        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    /**
     * Lấy Category theo id truyền vào
     */
    public function getCategoryById($id)
    {
        $obj_select = $this->connection->prepare('SELECT * FROM categories WHERE id = :id');
        $arr_select = [
            ':id' => $id
        ];

        $obj_select->execute($arr_select);

        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        if (isset($categories[0])) {
            return $categories[0];
        }

        return [];
    }

    /**
     * Lấy tổng số bản ghi trong bảng Category
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM categories WHERE TRUE $this->query_params");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    public function insert()
    {
        $obj_insert = $this->connection->prepare("INSERT INTO categories(`name`, `avatar`, `description`, `status`) VALUES (:name, :avatar, :description, :status)");
        $arr_insert = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status,
        ];

        return $obj_insert->execute($arr_insert);
    }

    /**
     * Update bản ghi theo id truyền vào
     */
    public function update($id)
    {
        $obj_update = $this
            ->connection
            ->prepare("UPDATE categories SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at WHERE id = $id");
        $arr_update = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];

        return $obj_update->execute($arr_update);
    }

    /**
     * Xóa bản ghi theo id truyền vào
     */
    public function delete($id)
    {
        $obj_delete = $this->connection->prepare("DELETE FROM categories WHERE id = $id");
        $is_delete = $obj_delete->execute();
        $obj_delete_product = $this->connection->prepare("DELETE FROM products WHERE category_id = $id");
        $obj_delete_product->execute();

        return $is_delete;
    }
}

?>