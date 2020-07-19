<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class CartController extends Controller
{
    public function add()
    {
        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);

        $product_cart = [
            'name' => $product['title'],
            'price' => $product['price'],
            'avatar' => $product['avatar'],
            'quality' => 1
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'][$id] = $product_cart;
        } else {
            if (!array_key_exists($id, $_SESSION['cart'])) {
                $_SESSION['cart'][$id] = $product_cart;
            } else {
                $_SESSION['cart'][$id]['quality']++;
            }
        }
        $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban';
        header("Location: $url_redirect");
        exit();
    }

    public function index()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['error'] = 'Làm gì có vào sản phẩm mà vào đây';
            $url_redirect = $_SERVER['SCRIPT_NAME'] . '/';
            header("Location: $url_redirect");
            exit();
        }

        if (isset($_POST['update_cart'])) {
            foreach ($_SESSION['cart'] AS $product_id => $product) {
                $_SESSION['cart'][$product_id]['quality'] = $_POST[$product_id];
            }
        }
        $category_model = new Category();
        $categories = $category_model->getAll();
        $this->content = $this->render('views/carts/index.php',[
            'categories' => $this->categories,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        $_SESSION['success'] = 'Xóa sản phẩm thành công';
        $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban';
        header("Location: $url_redirect");
        exit();
    }
}