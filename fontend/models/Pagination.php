<?php

class Pagination
{
    public $params = [
        'total' => 0,
        'limit' => 0,
        'query_string' => 'page',
        'controller' => '',
        'action' => '',
        'query_additional' => '',

    ];

    public $full_url;

    public function __construct($params = [])
    {
        if (isset($params['limit']) && $params['limit'] < 0) {
            die('limit không được nhỏ hơn 0');
        }
        if (isset($params['total']) && $params['total'] < 0) {
            die('total không được nhỏ hơn 0');
        }
        //validate query_string, nếu không có thì gán mặc định bằng page
        if (!isset($params['query_string'])) {
            $params['query_string'] = 'page';
        }
        //khởi tạo giá trị cho thuộc tính params bằng tham số params truyền vào constructor
        $this->params = $params;
        $query_additional = '';
        //nếu như query_additional đang khác rỗng, nghĩa là từ nơi gọi nó có truyền vào 1 tham số gì đó thì sẽ gán vào chuỗi url full đang có
        if (isset($this->params['query_additional']) && !empty($this->params['query_additional'])) {
            $query_additional = $this->params['query_additional'];
        }
        //tạo luôn url dạng abc?controller=&action=&page= để sử dụng cho các phương thức sau
        $this->full_url = $_SERVER['PHP_SELF'] . '?controller=' . $this->params['controller'] . '&action=' . $this->params['action'] . $query_additional . '&' . $this->params['query_string'] . '=';
    }

    /**
     * Lấy ra tổng số trang
     */
    public function getTotalPage()
    {
        $total = $this->params['total'] / $this->params['limit'];
        $total = ceil($total);
        return $total;
    }

    /**
     * LẤy ra trang hiện tại
     */
    public function getCurrentPage()
    {
        $page = 1;
        $query_string = $this->params['query_string'];
        //nếu tồn tại tham số query_string trên url, và giá trị của tham số này >= 1
        if (isset($_GET[$query_string]) && $_GET[$query_string] >= 1) {
            if ($_GET[$query_string] > $this->getTotalPage()) {
                $page = $this->getTotalPage();
            } else {
                $page = $_GET[$query_string];
            }
        }

        return $page;
    }

    /**
     * Trả về trang ngay trước trang hiện tại, tương đưuong với link Prev
     */
    public function getPrevPage()
    {
        $prev_page = '';
        if ($this->getCurrentPage() > 1) {
            $prev_link = $this->full_url . ($this->getCurrentPage() - 1);
            $prev_page = '<li class="page-item"><a class="page-link" href="' . $prev_link . '">Prev</a></li>';
        }

        return $prev_page;
    }

    /**
     * Hiển thị trang ngay sau trang hiện tại, tương đương với link Next
     */
    public function getNextPage()
    {
        $next_page = '';
        if ($this->getCurrentPage() < $this->getTotalPage()) {
            $next_link = $this->full_url . ($this->getCurrentPage() + 1);
            $next_page = '<li class="page-item"><a class="page-link" href="' . $next_link . '">Next</a></li>';
        }

        return $next_page;
    }

    /**
     * Hiển thị cấu trúc phân trang dạng HTML
     */
    public function getPagination()
    {
        if ($this->getTotalPage() == 1) {
            return '';
        }
        $data = '<ul class="pagination justify-content-center">';
        $data .= $this->getPrevPage();
        for ($i = 1; $i <= $this->getTotalPage(); $i++) {
            if ($i == $this->getCurrentPage()) {
                $link_current = $this->full_url . $i;
                $data .= "<li class='page-item active'><a class='page-link' href='$link_current'>$i</a></li>";
            } else {
                $link_current = $this->full_url . $i;
                $data .= "<li class='page-item'><a class='page-link' href='$link_current'>$i</a></li>";
            }
        }

        $data .= $this->getNextPage();
        $data .= '</ul>';
        return $data;
    }
}