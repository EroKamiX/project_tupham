<?php
require_once 'models/Model.php';

class Order extends Model
{
    public $fullname;
    public $user_id;
    public $address;
    public $mobile;
    public $email;
    public $note;
    public $price_total;
    public $payment_status;

    /**
     * Insert vào bảng orders
     */
    public function insert()
    {
        $sql_insert = "INSERT INTO orders(`user_id`,`fullname`, `address`, `mobile`, `email`, `note`, `price_total`, `payment_status`)
    VALUES (:user_id ,:fullname, :address, :mobile, :email, :note, :price_total, :payment_status)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $arr_insert = [
            ':user_id' => $this->user_id,
            ':fullname' => $this->fullname,
            ':address' => $this->address,
            ':mobile' => $this->mobile,
            ':email' => $this->email,
            ':note' => $this->note,
            ':price_total' => $this->price_total,
            ':payment_status' => $this->payment_status,
        ];
        $is_insert = $obj_insert->execute($arr_insert);
        //
        if ($is_insert) {
            $order_id = $this->connection->lastInsertId();
            return $order_id;
        }

        return FALSE;
    }

    /**
     * Lấy thông tin đơn hàng theo id
     */
    public function getOrder($id)
    {
        $sql_select = "SELECT * FROM orders WHERE `id` = $id";
        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();

        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
}