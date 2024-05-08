<?php

namespace backend\helpers;

class OrderStatus
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;
    const STATUS_CANCEL = 3;

    private static $data = [
        '1' => 'รอชำระเงิน',
        '2' => 'กำลังดำเนินการ',
        '3' => 'กำลังจัดส่ง',
        '4' => 'จัดส่งสำเร็จ',
        '5' => 'ยกเลิกคำสั่งซื้อ',
    ];

    /**
     * @var \string[][]
     */
    private static $dataobj = array(
        array('id' => '1', 'name' => 'รอชำระเงิน'),
        array('id' => '2', 'name' => 'กำลังดำเนินการ'),
        array('id' => '3', 'name' => 'กำลังจัดส่ง'),
        array('id' => '4', 'name' => 'จัดส่งสำเร็จ'),
        array('id' => '5', 'name' => 'ยกเลิกคำสั่งซื้อ')
    );

    public static function asArray()
    {
        return self::$data;
    }

    public static function asArrayObject()
    {
        return self::$dataobj;
    }

    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown';
    }

    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown';
    }
}
