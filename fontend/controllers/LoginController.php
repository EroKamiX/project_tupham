<?php
require_once "models/User.php";

class LoginController
{
    public $content;
    public $error;

    /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function render($file, $variables = [])
    {
        extract($variables);
        ob_start();
        require_once $file;
        $render_view = ob_get_clean();

        return $render_view;
    }

    /**
     * @return mixed
     */
    public function register()
    {
        if (isset($_POST['submit'])) {

            $pattern = "/^[A-Za-z0-9_\.]{8,32}$/";
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            if (empty($username)) {
                $this->error = "Không Được Để Trống Tên Đăng Nhập";
            } else if (empty($email)) {
                $this->error = "Không Được Để Trống Tên Email";
            } else if (empty($phone)) {
                $this->error = "Không Được Để Trống Tên Số Điện Thoại";
            } else if (empty($password)) {
                $this->error = "Không Được Để Trống Tên Số Mật Khẩu";
            } else if (empty($confirm)) {
                $this->error = "Cần Xác Nhận mật khẩu";
            } else if (!preg_match($pattern, $password)) {
                $this->error = "Mật khẩu tối thiểu 8 kí tự và không có kí tự đặc biệt";
            } else if ($password != $confirm) {
                $this->error = "Password Chưa trùng khớp";
            } elseif (empty($this->error)) {
                $user_model = new User();
                $user_model->username = $username;
                $user_model->email = $email;
                $user_model->phone = $phone;
                $is_exist = $user_model->CheckExist($username);
                if ($is_exist) {
                    $this->error = "Username $username Đã Tồn Tại";
                    die();
                }
                $user_model->password = $password = md5($password);
                $is_register = $user_model->register();
                if ($is_register) {
                    $_SESSION['success'] = "Đăng Ký Thành Công";
                } else {
                    $_SESSION['error'] = "Đăng Ký Thất Bại";
                }
                $url_redirect = $_SERVER['SCRIPT_NAME'] . '/dang-nhap';
                header("Location: $url_redirect");
                exit();
            }

        }
        $this->content = $this->render('views/users/register.php');
        require_once 'views/layouts/main_login.php';
    }

    public function login()
    {

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (empty($username) || empty($password)) {
                $this->error = "Không Được Để Trống Các Trường";
            }
            if (empty($this->error)) {
                $user_model = new User();
                $password = md5($password);
                $user = $user_model->GetUserLogin($username, $password);
                if (!empty($user)) {
                    $_SESSION['user'] = $user;
                    $_SESSION['success'] = "Đăng Nhập Thành Công";
                    $url_redirect = $_SERVER['SCRIPT_NAME'] . '/';
                    header("Location: $url_redirect");
                    exit();
                } else {
                    $this->error = "Sai Tên Tài Khoản Hoặc Mật Khẩu";
                }
            }
        }
        $this->content = $this->render("views/users/login.php");
        require_once "views/layouts/main_login.php";
    }

    public function logout()
    {

        unset($_SESSION['user']);
        header("Location: index.php");
        exit();
    }
}