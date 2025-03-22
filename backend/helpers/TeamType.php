<?php

namespace backend\helpers;

class TeamType
{
    private static $data = [
        '1' => 'ทีมขาย',
        '2' => 'ทีมช่าง'
    ];

    private static $dataobj = [
        ['id'=>'1','name' => 'ทีมขาย'],
        ['id'=>'2','name' => 'ทีมช่าง']
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
