<?php
//File index gốc của ứng dụng
session_start();
//Set lại múi giờ Việt Nam
date_default_timezone_set("Asia/Ho_Chi_Minh");

//Lấy giá trị tham số controller và action từ trình duyệt
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'category';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

//Nhúng file CategoryController.php vào
//Chuyển kí tự đầu tiên của $controller thành chữ hoa
$controller = ucfirst($controller); //
$controller .= 'Controller';//CategoryController
//Tạo biến chứa đường dẫn controller sẽ nhúng vào
$path_controller = "controllers/$controller.php";

if (!file_exists($path_controller)){
    die("Trang bạn tìm không tồn tại");
}
require_once "$path_controller";

//Sau khi nhúng file thì đã có thể dùng class Controller tương ứng
$object = new $controller;

if (!method_exists($object, $action)){
    die("Phương thức $action không tồn tại trong class $controller");
}
$object->$action();

?>