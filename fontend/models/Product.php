<?php
require_once 'models/Model.php';
require_once 'models/category.php';
class Product extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $avatar;
    public $price;
    public $summary;
    public $content;
    public $status;
    public $created_at;
    public $updated_at;

    public $str_search = '';
    public $str_sort = 'products.updated_at DESC, products.created_at DESC';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND products.title LIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $this->str_search .= " AND products.category_id = {$_GET['category_id']}";
        }


    }
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM products WHERE TRUE $this->str_search");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE TRUE $this->str_search
                       order BY products.updated_at DESC, products.created_at DESC 
                        LIMIT $start, $limit");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function getAllProduct()
    {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.names AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        ORDER BY categories.created_at ASC");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function detail($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM `products` WHERE `id` = $id");
        $obj_select->execute();
        $product = $obj_select->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    public function getProduct($category_id) {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.names AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE TRUE AND products.category_id  = $category_id
                        ORDER BY products.updated_at DESC, products.created_at DESC
                        LIMIT 8");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM products 
          WHERE id = $id");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
}