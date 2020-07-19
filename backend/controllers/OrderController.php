<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 6/19/2020
 * Time: 9:14 AM
 */
require_once "controllers/controller.php";
require_once "models/Order.php";
class OrderController extends Controller
{
    public function index() {
        $orders_model = New Order();
        $orders = $orders_model ->getAllOrder();
        $this->content = $this->render('views/orders/index.php',[
            'orders' => $orders,
        ]);
        require_once 'views/layouts/main.php';
    }
    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order');
            exit();
        }

        $id = $_GET['id'];
        $orders_model = New Order();
        $order = $orders_model ->getOrder($id);
        print_r($order);
        $this->content = $this->render('views/orders/detail.php',[
            'order' => $order,
        ]);
        require_once 'views/layouts/main.php';
    }
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order');
            exit();
        }

        $id = $_GET['id'];
        $orders_model = new Order();
        $order = $orders_model->getOrder($id);
        //xử lý submit form
        if (isset($_POST['submit'])) {

            $status = $_POST['status'];

            if (empty($this->error)) {

                $order_model = new Order();

                $order_model->status = $status;
                $is_insert = $order_model->update($id);
                if ($is_insert) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=order');
                exit();

            }
        }


        $this->content = $this->render('views/orders/update.php', [

            'order' => $order,
        ]);
        require_once 'views/layouts/main.php';
    }
    public function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order');
        }

        $id = $_GET['id'];
        $order_model = new Order();
        $is_delete = $order_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=order');
        exit();
    }
}