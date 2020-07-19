<?php
require_once 'models/category.php';
require_once 'models/Model.php';
class Category extends Model
{

public $names;
public $title;
public $pic_des;
public $description;
public $updated_at;

    /**
     * @return mixed
     */
    public function insert()
    {

        $obj_insert = $this->connection->prepare("INSERT INTO
        Categories(`title`,`pic_des`,`description`,`names`) VALUES (:title, :pic_des, :description, :names)");
        $arr_insert = [
            ':title' => $this ->title,
            ':pic_des' => $this ->pic_des,
            ':description' => $this ->description,
            ':names' => $this->names,
        ];
        $is_insert = $obj_insert->execute($arr_insert);
        return $is_insert;
    }
    public function GetAll() {
        $obj_select = $this->connection->prepare("SELECT * FROM categories WHERE `status` = 0 ORDER BY categories.position DESC");
        $obj_select ->execute();
        $news = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $news;
    }
    public function detail($id) {

        $obj_detail = $this->connection->prepare("SELECT * FROM categories WHERE id = $id");
        $detail_arr = [
            ":id" => $id,
        ];
        $obj_detail->execute($detail_arr);
        $categories = $obj_detail->fetchAll(PDO::FETCH_ASSOC);
        $category = $categories[0];
            return $category;

    }

}
