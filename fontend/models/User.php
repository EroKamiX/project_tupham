<?php
require_once "models/Model.php";

class User extends Model
{
    public $username;
    public $password;
    public $phone;
    public $email;
    public $first_name;
    public $last_name;
    public $avatar;
    public $address;
    public $updated_at;

    public function register()
    {
        $obj_insert = $this->connection->prepare("INSERT INTO users(`username`, `password`,`email`,`phone`) VALUES (:username, :password, :email, :phone)");
        $arr_insert = [
            ':username' => $this->username,
            ':password' => $this->password,
            ':email' => $this->email,
            ':phone' => $this->phone,
        ];

        return $obj_insert->execute($arr_insert);
    }

    public function CheckExist($username)
    {
        $obj_select = $this->connection->prepare("SELECT * FROM users WHERE `username`=:username");
        $arr_select = [
            ":username" => $username,
        ];
        $obj_select->execute($arr_select);
        $user = $obj_select->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return TRUE;
        }
        return FALSE;
    }

    public function GetUserLogin($username, $password)
    {
        $obj_select = $this->connection->prepare("SELECT * FROM users WHERE `username`=:username AND `password`=:password");
        $arr_select = [
            ":username" => $username,
            ":password" => $password,
        ];
        $obj_select->execute($arr_select);
        $user = $obj_select->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function Pro5($username)
    {
        $obj_select = $this->connection->prepare("SELECT * FROM users WHERE `username`=:username");
        $arr_select = [
            ":username" => $username,
        ];
        $obj_select->execute($arr_select);
        $user = $obj_select->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, phone=:phone, 
            email=:email, address=:address,`avatar`= :avatar, updated_at=:updated_at WHERE id = $id
");
        $arr_update = [
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':email' => $this->email,
            ':address' => $this->address,
            ':avatar' => $this->avatar,
            ':updated_at' => $this->updated_at,
        ];
        return $obj_update->execute($arr_update);
    }

    public function changePw($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE users SET `password` = :password, updated_at=:updated_at WHERE id = $id
");
        $arr_update = [
            ':password' => $this->password,
            ':updated_at' => $this->updated_at,

        ];
        return $obj_update->execute($arr_update);
    }

    public function getOrderDetail($user_id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT order_details.*, products.title AS product_title, orders.payment_status AS status FROM order_details 
                        INNER JOIN orders ON orders.id = order_details.order_id INNER JOIN products ON products.id = order_details.product_id WHERE orders.user_id = $user_id
");

        $obj_select->execute();
        $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }
}