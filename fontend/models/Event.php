<?php
require_once 'models/Model.php';
class Event extends Model
{
    public $str_search;
    public $picture;
    public $title;
    public $status;
    public $created_at;
    public $updated_at;

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

    public function getAllEvent()
    {

        $obj_select = $this->connection
            ->prepare("SELECT * FROM events
                        WHERE TRUE $this->str_search
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
}