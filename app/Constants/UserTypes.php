<?php

namespace App\Constants;

final class UserTypes
{
    const ADMIN  = 1;
    const SEEKER = 2;
    const OWNER = 3;

    public static function getList()
    {
        return [
            UserTypes::ADMIN => trans("admin"),
            UserTypes::SEEKER => trans("seeker"),
            UserTypes::OWNER => trans("owner"),
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
