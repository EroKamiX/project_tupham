<?php
class Helper
{
    const STATUS_STOCKING = 0;
    const STATUS_OUTSTOCK = 1;
    const STATUS_STOP = 2;
    const STATUS_STOCKING_TEXT = 'Còn hàng';
    const STATUS_OUTSTOCK_TEXT = 'Hết hàng';
    const STATUS_STOP_TEXT = 'Ngừng kinh doanh';

    /**
     * Get status text
     * @param int $status
     * @return string
     */
    public static function getStatusText($status = 0) {
        $status_text = '';
        switch ($status) {
            case self::STATUS_STOCKING:
                $status_text = self::STATUS_STOCKING_TEXT;
                break;
            case self::STATUS_OUTSTOCK:
                $status_text = self::STATUS_OUTSTOCK_TEXT;
                break;
            case self::STATUS_STOP:
                $status_text = self::STATUS_STOP_TEXT;
                break;
        }
        return $status_text;
    }

}