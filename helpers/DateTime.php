<?php
/**
 * Created by PhpStorm.
 * User: programmer6
 * Date: 23.12.2015
 * Time: 16:47
 */

namespace app\helpers;


class DateTime
{
    static function toSql($dateTime,$format = 'd.m.Y') {
        return \DateTime::createFromFormat($format,$dateTime)->format('Y-m-d H:i:s');
    }

    static function fromSql($dateTime,$format = 'd.m.Y') {
        return \DateTime::createFromFormat('Y-m-d H:i:s',$dateTime)->format($format);
    }
}