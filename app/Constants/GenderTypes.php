<?php


namespace App\Constants;


final class GenderTypes
{
    const MALE = 0;
    const FEMALE = 1;

    public static function getList()
    {
        return [
            GenderTypes::MALE => trans("male"),
            GenderTypes::FEMALE => trans("female"),
        ];
    }

    public static function getOne($key)
    {

        if (!array_key_exists($key, self::getList())) {
            return "";
        }
        return self::getList()[$key];
    }

}
