<?php

namespace App\Constants;

final class CareerLevels
{
    const STUDENT = 1;
    const ENTRY_LEVEL = 2;
    const MID_CAREER = 3;
    const MANAGEMENT = 4;
    const DIRECTOR_HEAD = 5;
    const SENIOR_EXECUTIVE = 6;

    public static function getList()
    {
        return [
            CareerLevels::STUDENT => trans('student') ,
            CareerLevels::ENTRY_LEVEL => trans('entry_level') ,
            CareerLevels::MID_CAREER => trans('mid_career'),
            CareerLevels::MANAGEMENT => trans('management'),
            CareerLevels::DIRECTOR_HEAD => trans('director_head') ,
            CareerLevels::SENIOR_EXECUTIVE => trans('senior_executive'),
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
