<?php


namespace App\Models\Enum;


class OrderEnum
{
    const UNPAID = 0;
    const UNCHECK = 1;
    const INLINE = 2;
    const CHECKING = 3;
    const CHECKED = 4;
    const TIMEOUT = 5;
    const CANCEL = 6;
    const REFUNDED = 7;

    public static function getStatusName($status)
    {
        switch ($status) {
            case self::UNPAID:
                return '待支付';
            case self::UNCHECK:
                return '待检测';
            case self::INLINE:
                return '排队中';
            case self::CHECKING:
                return '检测中';
        }
    }
}
