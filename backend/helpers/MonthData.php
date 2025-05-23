<?php

namespace backend\helpers;

class MonthData
{
    private static $data = [
        '1' => 'Jan',
        '2' => 'Feb',
        '3' => 'Mar',
        '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Aug',
        '9' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec'
    ];

    private static $dataobj = [
        ['id' => 1, 'name' => 'Jan'],
        ['id' => 2, 'name' => 'Feb'],
        ['id' => 3, 'name' => 'Mar'],
        ['id' => 4, 'name' => 'Apr'],
        ['id' => 5, 'name' => 'May'],
        ['id' => 6, 'name' => 'Jun'],
        ['id' => 7, 'name' => 'Jul'],
        ['id' => 8, 'name' => 'Aug'],
        ['id' => 9, 'name' => 'Sep'],
        ['id' => 10, 'name' => 'Oct'],
        ['id' => 11, 'name' => 'Nov'],
        ['id' => 12, 'name' => 'Dec']
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
