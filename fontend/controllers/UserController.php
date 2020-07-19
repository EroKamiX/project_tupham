<?php
require_once "models/User.php";
require_once "controllers/Controller.php";

class UserController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Bạn Chưa Đang nhập Tài Khoản";
            $url_redirect = $_SERVER['SCRIPT_NAME'] . '/';
            header("Location: $url_redirect");
            exit();
        }
    }

    public function profile()
    {
        $this->content = $this->render('views/users/profile.php', [
            'user' => $_SESSION['user'],
        ]);
        require_once 'views/layouts/main.php';
    }

    public function update()
    {
        $user = $_SESSION['user'];
        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            //xử lý validate
            if (empty($email)) {
                $this->error = 'Không được để trống Email';
            } elseif (!is_numeric($phone)) {
                $this->error = 'Nhập đúng số điện thoại';
            }
            if (empty($this->error)) {
                $filename = $user['avatar'];
                //xử lý upload file nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../../mvc/assets/user/';
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-avatar-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //save dữ liệu vào bảng products
                $users_model = new User();
                $users_model->first_name = $first_name;
                $users_model->last_name = $last_name;
                $users_model->phone = $phone;
                $users_model->avatar = $filename;
                $users_model->email = $email;
                $users_model->address = $address;

                $is_update = $users_model->update($_SESSION['user']['id']);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                    $_SESSION['user'] = $users_model->Pro5($user['username']);
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                $url_redirect = $_SERVER['SCRIPT_NAME'] . '/profile';
                header("Location: $url_redirect");
                exit();

            }
        }
        $this->content = $this->render('views/users/update.php', [
            'user' => $_SESSION['user'],
        ]);
        require_once 'views/layouts/main.php';
    }

    public function changePw()
    {
        $user = $_SESSION['user'];

        $id = $user['id'];
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $new_password = $_POST['new_password'];
            $confirm = $_POST['confirm'];
            $pattern = "/^[A-Za-z0-9_\.]{8,32}$/";
            if (empty($password) || empty($new_password) || empty($confirm)) {
                $this->error = "Không được để trống các trường";
            } elseif ($new_password != $confirm) {
                $this->error = "Mật khẩu mới chưa trùng Khớp";
            } elseif ($user['password'] != md5($password)) {
                $this->error = "Nhập sai mật khẩu cũ";
            } elseif (!preg_match($pattern, $new_password)) {
                $this->error = "Tối thiểu 8 kí tự";
            }
            if (empty($this->error)) {
                $users_model = new User();
                $users_model->password = md5($password);
                $is_change = $users_model->changePw($id);
                if ($is_change) {
                    $_SESSION['success'] = "Đổi mật khẩu thành công";
                } else {
                    $_SESSION['error'] = "Đổi mật khẩu thất bại";
                }
                header("Location: profile");
                exit();
            }

        }
        $this->content = $this->render('views/users/password.php', [
            'user' => $user,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function detail()
    {
        $user = $_SESSION['user'];
        $user_model = new User();
        $orders = $user_model->getOrderDetail($user['id']);
        $this->content = $this->render('views/users/order_detail.php', [
            'orders' => $orders,
        ]);
        require_once 'views/layouts/main.php';
    }
}