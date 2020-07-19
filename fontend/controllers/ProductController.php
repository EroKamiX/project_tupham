<?php
require_once "controllers/Controller.php";
require_once "models/Product.php";
require_once "models/Category.php";
require_once "models/Pagination.php";

class ProductController extends Controller
{
    public function index()
    {
        $product_model = new Product();
        $count_total = $product_model->countTotal();
        $arr_params = [
            'total' => $count_total,
            'limit' => 10,
            'query_string' => 'page',
            'controller' => 'product',
            'action' => 'index',
            'query_additional' => '',
            'page' => isset($_GET['page']) ? $_GET['page'] : 1,
        ];

        $products = $product_model->getAllPagination($arr_params);
        $pagination = new Pagination($arr_params);
        $pages = $pagination->getPagination();
        $category_model = new Category();
        $categories = $category_model->getAll();
        $this->content = $this->render("views/products/index.php", [
            'products' => $products,
            'pages' => $pages,
            'categories' => $this->categories,
        ]);
        require_once "views/layouts/main.php";
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header("Location: {$_SERVER['SCRIPT_NAME']}");
            exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
        $category_model = new Category();
        $categories = $category_model->getAll();
        if (empty($product)) {
            $_SESSION['error'] = 'Sẩn Phẩm Không Tồn tại';

            header("Location: {$_SERVER['SCRIPT_NAME']}");
            exit();
        }
        $this->content = $this->render('views/products/detail.php', [
            'product' => $product,
        ]);
        require_once "views/layouts/main.php";
    }

    public function filter()
    {
        $product_model = new Product();

        //lấy tổng số bản ghi đang có trong bảng products
        $count_total = $product_model->countTotal();
        //xử lý phân trang
        $query_additional = '';
        if (isset($_GET['title'])) {
            $query_additional .= '&search=' . $_GET['title'];
        }
        if (isset($_GET['category_id'])) {
            $query_additional .= '&category_id=' . $_GET['category_id'];
        }
        $arr_params = [
            'total' => $count_total,
            'limit' => 16,
            'query_string' => 'page',
            'controller' => 'product',
            'action' => 'filter',
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $products = $product_model->getAllPagination($arr_params);
        $pagination = new Pagination($arr_params);
        $category_model = new Category();
        $categories = $category_model->getAll();
        $pages = $pagination->getPagination();
        $this->content = $this->render("views/products/filter.php", [
            'products' => $products,
            'pages' => $pages,
        ]);
        require_once "views/layouts/main.php";
    }

}