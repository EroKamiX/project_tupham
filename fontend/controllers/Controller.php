<?php
class Controller
{
    public $content;
    public $error;
    public $categories;
    public function render($file, $variables = [])
    {
        extract($variables);
        ob_start();
        require_once $file;
        $render_view = ob_get_clean();

        return $render_view;
    }
    public function __construct()
    {
        $category_model = new Category();
        $this->categories  = $category_model->getAll();
        $this->render("views/layouts/header.php",[
            'categories'  => $this->categories
        ]);
        $this->render("views/layouts/footer.php",[
            'categories'  => $this->categories
        ]);
        return $this->categories;
    }
}