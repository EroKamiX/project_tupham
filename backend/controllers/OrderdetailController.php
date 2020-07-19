<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 6/19/2020
 * Time: 11:14 AM
 */
require_once "controllers/controller.php";
require_once "models/Orderdetail.php";
class OrderdetailController extends Controller
{
    public function index() {
        $orders_model = New Orderdetail();
        $orders = $orders_model ->getAll();
        $this->content = $this->render('views/order_details/index.php',[
            'orders' => $orders,
        ]);
        require_once 'views/layouts/main.php';
    }
}