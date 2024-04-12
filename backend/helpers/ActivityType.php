<?php

namespace backend\helpers;

class ActivityType
{
    private static $data = [
        '1' => 'รับเข้าใบสั่งซื้อ',
        '2' => 'ยกเลิกรับสั่งซื้อ',
        '3' => 'เบิก',
        '4' => 'คืนเบิก',
        '5' => 'บันทึกสดย่อย',
        '6' => 'บันทึกรับ',
    ];

    private static $dataobj = [
        ['id' => '1', 'name' => 'รับเข้าใบสั่งซื้อ'],
        ['id' => '2', 'name' => 'ยกเลิกรับสั่งซื้อ'],
        ['id' => '3', 'name' => 'เบิก'],
        ['id' => '4', 'name' => 'คืนเบิก'],
        ['id' => '5', 'name' => 'บันทึกสดย่อย'],
        ['id' => '6', 'name' => 'บันทึกรับ'],
    ];

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

        return 'Unknown Type';
    }

    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
