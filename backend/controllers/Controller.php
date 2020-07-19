<?php

class Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Bạn cần đăng nhập';
            header('Location: index.php?controller=login&action=login');
            exit();
        }
    }

    public $content; //Chứa nội dung view
    public $error; //Chứa nội dung lỗi validate

    public function render($file, $variable = [])
    {
        extract($variable);
        ob_start();
        require_once $file;

        $render_view = ob_get_clean();

        return $render_view;
    }
}

?>