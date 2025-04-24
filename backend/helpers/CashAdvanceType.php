<?php

namespace backend\helpers;

class CashAdvanceType
{
    private static $data = [
        '1' => 'รายรับ/เงินคงเหลือยกมา',
        '2' => 'รายรับ/เบิกเงิน Cash advance จากบริษัท',
        '3' => 'รายจ่ายทั่วไปของบริษัท',
        '4' => 'รายจ่ายงายขาย/ติดตั้ง-แบบคิดภาษีมูลค่าเพิ่ม 7%',
        '5' => 'รายจ่ายงายขาย/ติดตั้ง -แบบไม่คิดภาษีมูลค่าเพิ่ม 7%',
    ];

    private static $dataobj = [
        ['id'=>'1','name' => 'รายรับ/เงินคงเหลือยกมา'],
        ['id'=>'2','name' => 'รายรับ/เบิกเงิน Cash advance จากบริษัท'],
        ['id'=>'3','name' => 'รายจ่ายทั่วไปของบริษัท'],
        ['id'=>'4','name' => 'รายจ่ายงายขาย/ติดตั้ง-แบบคิดภาษีมูลค่าเพิ่ม 7%'],
        ['id'=>'5','name' => 'รายจ่ายงายขาย/ติดตั้ง -แบบไม่คิดภาษีมูลค่าเพิ่ม 7%']
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
