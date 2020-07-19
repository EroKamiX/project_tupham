<?php
require_once 'models/User.php';

class LoginController
{
    public $content; //chứa nội dung view
    public $error; //chứa nội dung lỗi validate

    /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function render($file, $variables = [])
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        extract($variables);
        ob_start();
        require_once $file;
        $render_view = ob_get_clean();

        return $render_view;
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=category&action=index');
            exit();
        }
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            if (empty($username) || empty($password)) {
                $this->error = 'Username hoặc password không được để trống';
            }

            $user_model = new User();
            if (empty($this->error)) {
                $user = $user_model->getUserByUsernameAndPassword($username, $password);

                if (empty($user)) {
                    $this->error = 'Sai username hoặc password';
                } else {
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    $_SESSION['user'] = $user;
                    header("Location: index.php?controller=product");
                    exit();
                }
            }
        }
        $this->content = $this->render('views/users/login.php');

        require_once 'views/layouts/main_login.php';
    }

    /**
     * Đăng ký tài khoản mới, mặc định tất cả các user đều có quyền admin
     */
    public function register()
    {

        if (isset($_POST['submit'])) {
            $user_model = new User();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $user = $user_model->getUserByUsername($username);

            if (empty($username) || empty($password) || empty($password_confirm)) {
                $this->error = 'Không được để trống các trường';
            } else if ($password != $password_confirm) {
                $this->error = 'Password nhập lại chưa đúng';
            } else if (!empty($user)) {
                $this->error = 'Username này đã tồn tại';
            }

            if (empty($this->error)) {

                $user_model->username = $username;
                $user_model->password = md5($password);
                $user_model->status = 1;
                $is_insert = $user_model->insertRegister();
                if ($is_insert) {
                    $_SESSION['success'] = 'Đăng ký thành công';
                } else {
                    $_SESSION['error'] = 'Đăng ký thất bại';
                }
                header('Location: index.php?controller=login&action=login');
                exit();
            }
        }

        $this->content = $this->render('views/users/register.php');
        require_once 'views/layouts/main_login.php';
    }
}