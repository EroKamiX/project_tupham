<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 6/19/2020
 * Time: 11:16 AM
 */
require_once "models/Model.php";
class Orderdetail extends Model
{
    public function getAll() {
        $obj_select = $this->connection
            ->prepare("SELECT order_details.*, products.title AS product_title, orders.payment_status AS status FROM order_details 
                        INNER JOIN orders ON orders.id = order_details.order_id INNER JOIN  products ON products.id = product_id");

        $obj_select->execute();
        $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }
}