<?php

namespace backend\helpers;

class CostDeductType
{
    private static $data = [
        '1' => 'ค่าสินค้า',
        '2' => 'ค่าบริการ'
    ];

    private static $dataobj = [
        ['id'=>'1','name' => 'ค่าสินค้า'],
        ['id'=>'2','name' => 'ค่าบริการ']
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
