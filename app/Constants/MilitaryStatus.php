<?php

namespace App\Constants;

final class MilitaryStatus
{
    const EXEMPTION  = 1;
    const SERVES_IN_ARMY   = 2;
    const DELAYED = 3;

    public static function getList()
    {
        return [
            MilitaryStatus::EXEMPTION => trans("exemption"),
            MilitaryStatus::SERVES_IN_ARMY => trans("serves_in_army"),
            MilitaryStatus::DELAYED => trans("delayed"),
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
