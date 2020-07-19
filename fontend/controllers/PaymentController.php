<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'models/Product.php';
//nhúng thư viên gửi mail
require_once 'configs/PHPMailer/src/PHPMailer.php';
require_once 'configs/PHPMailer/src/SMTP.php';
require_once 'configs/PHPMailer/src/Exception.php';

class PaymentController extends Controller
{

    public function index()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['error'] = 'Bạn chưa có sản phẩm nào trong giỏ hàng';
            header("Location: index.php");
            exit();
        }

        //xử lý submit form khi user click Thanh toán
        if (isset($_POST['submit'])) {
            //lấy giá trị từ form
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            //check validate
            if (empty($fullname) || empty($address) || empty($mobile)) {
                $this->error = 'Fullname, address, mobile ko đc để trống';
            }

            if (empty($this->error)) {
                $order_model = new Order();
                $order_model->user_id = $_SESSION['user']['id'];
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->email = $email;
                $order_model->note = $note;
                $price_total = 0;

                foreach ($_SESSION['cart'] as $cart) {
                    $price_total += $cart['quality'] * $cart['price'];
                }
                $order_model->price_total = $price_total;

                $order_model->payment_status = 0;

                $order_id = $order_model->insert();

                if ($order_id > 0) {
                    //lưu vào bảng order_details

                    $order_detail = new OrderDetail();
                    $order_detail->order_id = $order_id;
                    //bảng order_details là bảng mô tả chi tiết thông tin về order đó như sản phẩm nào đang có số lượng là bao nhiêu
                    //nên cần lặp giỏ hàng để lưu
                    foreach ($_SESSION['cart'] AS $product_id => $cart) {
                        $order_detail->product_id = $product_id;
                        $order_detail->quality = $cart['quality'];
                        $order_detail->insert();
                    }

                    $_SESSION['success'] = 'Bạn đã đặt hàng thành công';
                    //tạo message để gửi mail cho kh vừa đặt hàng

                    $message = "Cảm ơn bạn đã đặt hàng, $fullname";
                    $message .= "<br>";
                    $message .= "Bạn đã đặt hàng <br>";
                    $message .= "<div class='container'>";

                    $message .= "<table border='1' cellpadding='5' cellspacing='0'>";
                    $message .= "<tr>";
                    $message .= "<td>Sản phẩm</td>";
                    $message .= "<td>Số Lượng</td>";
                    $message .= "<td>Tổng giá trị đơn hàng</td>";
                    $message .= "</tr>";
                    foreach ($_SESSION['cart'] AS $product_id => $cart) {

                        $message .= "<tr>";
                        $price = $cart['price'] * $cart['quality'];
                        $message .= "<td>".$cart['name']."</td>";
                        $message .= "<td>".$cart['quality']."</td>";
                        $message .= "<td>".number_format($price)."</td>";
                        $message .= "</tr>";
                    }
                    $message .= "</table>";
                    $message .= "</div>";
                    //gửi mail theo địa chỉ email của kh
                    $this->sendMail($email, $message, $fullname);
                    unset($_SESSION['cart']);
                    //chuyển hướng về trang cảm ơn
                    header("Location: cam-on");
                    exit();
                } else {
                    $_SESSION['error'] = 'Lưu thông tin thanh toán thất bại';
                    header("Location: thanh-toan");
                    exit();
                }
            }
        }
        $category_model = new Category();
        $categories = $category_model->getAll();
        $this->content = $this->render('views/payments/index.php',[
            'categories' => $this->categories,
        ]);
        require_once 'views/layouts/main.php';
    }

    /**
     * Trang cảm ơn
     */

    public function thank()
    {   $category_model = new Category();
        $categories = $category_model->getAll();
        $this->content = $this->render('views/payments/thank.php',[
            'categories' => $this->categories,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function buy()
    {
        $product_model = new Product();

        $id = $_GET['id'];

        $product = $product_model->getById($id);
        if (empty($product)) {
            $_SESSION['error'] = 'Sẩn Phẩm Không Tồn tại';

            header("Location: {$_SERVER['SCRIPT_NAME']}");
            exit();
        }
        $product_buy = [
            $product['id'] => [
                'name' => $product['title'],
                'price' => $product['price'],
                'avatar' => $product['avatar'],
                'quality' => 1
            ]

        ];

        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];

            if (empty($fullname) || empty($address) || empty($mobile)) {
                $this->error = 'Fullname, address, mobile ko đc để trống';
            }

            if (empty($this->error)) {
                $order_model = new Order();
                $order_model->user_id = $_SESSION['user']['id'];
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->email = $email;
                $order_model->note = $note;
                $order_model->price_total = $product['price'];

                $order_model->payment_status = 0;

                $order_id = $order_model->insert();

                if ($order_id > 0) {
                    $message = "Cảm ơn bạn đã đặt hàng, $fullname";
                    if ($this->sendMail($email, $message, $fullname) == TRUE) {
                        $order_detail = new OrderDetail();
                        $order_detail->order_id = $order_id;
                        foreach ($product_buy AS $product_id => $cart) {
                            $order_detail->product_id = $product_id;
                            $order_detail->quality = $cart['quality'];
                            $order_detail->insert();
                        }
                        $_SESSION['success'] = 'Bạn đã đặt hàng thành công';
                    } else {
                        $_SESSION['error'] = "Đạt hàng thất bại! Vui lòng kiểm tra đường truyền và thử lại";
                    }
                    header("Location: cam-on");
                    exit();
                } else {
                    $_SESSION['error'] = 'Lưu thông tin thanh toán thất bại';
                    header("Location: thanh-toan");
                    exit();
                }
            }
        }
        $this->content = $this->render('views/payments/index.php', [
            'product_buy' => $product_buy,
        ]);
        require_once 'views/layouts/main.php';
    }

    /**
     * Gửi mail, tham khảo cách sử dụng của thư viện PHPMailer theo link: https://github.com/PHPMailer/PHPMailer
     * @param $email
     */
    protected function sendMail($email, $message, $fullname)
    {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'tupham1120@gmail.com';                     // SMTP username (username gmail của chính bạn)
            $mail->Password = 'ietwtncaapzjqdxr';                               // SMTP password
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('tutu@gmail.com', 'tu tu');
            //setting mail người gửi
            $mail->addAddress($email, $fullname);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->CharSet = "UTF-8";
            $mail->Subject = 'Cảm ơn bạn đã đặt hàng';
            $mail->Body = $message;

            $mail->send();
            return TRUE;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return FALSE;
        }
    }
}