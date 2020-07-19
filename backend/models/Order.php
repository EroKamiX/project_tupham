<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 6/19/2020
 * Time: 9:14 AM
 */
require_once 'models/Model.php';
class Order extends Model
{
    public $status;
    public $updated_at;
    public function getAllOrder() {
        $obj_select = $this->connection
            ->prepare("SELECT orders.*, users.username AS user_name FROM orders 
                        INNER JOIN users ON users.id = orders.user_id
                        ORDER BY orders.updated_at DESC, orders.created_at DESC
                        ");

        $obj_select->execute();
        $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }
    public function getOrder($id) {
        $obj_select = $this->connection
            ->prepare("SELECT orders.*, users.username AS user_name FROM orders 
                        INNER JOIN users ON users.id = orders.user_id WHERE orders.id = $id
                        ");

        $obj_select->execute();
        $order = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $order;
    }
    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE orders SET payment_status=:status, updated_at=:updated_at WHERE id = $id
");
        $arr_update = [
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];
        return $obj_update->execute($arr_update);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE orders.* , order_details.* FROM orders INNER JOIN order_details ON order_details.order_id = orders.id  WHERE orders.id = $id AND order_details.order_id = $id");
        return $obj_delete->execute();
    }
}