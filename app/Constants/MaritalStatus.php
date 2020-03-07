<?php

namespace App\Constants;

final class MaritalStatus
{
    const MARRIED  = 1;
    const SINGLE   = 2;
    const DIVORCED = 3;
    const WIDOWED  = 4;

    public static function getList()
    {
        return [
            MaritalStatus::MARRIED => trans("married"),
            MaritalStatus::SINGLE => trans("single"),
            MaritalStatus::DIVORCED => trans("divorced"),
            MaritalStatus::WIDOWED => trans("widowed"),
        ];
    }

    public static function getOne($index = '')
    {
        $list = self::getList();
        $list_one = '';
        if ($index) {
            $list_one = $list[$index];
        }
        return $list_one;
    }
}
