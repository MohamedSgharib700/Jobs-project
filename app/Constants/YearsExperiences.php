<?php

namespace App\Constants;

final class YearsExperiences
{
    const YEARS_EXPERIENCES_LESS1 = 1;
    const YEARS_EXPERIENCES_1TO2  = 2;
    const YEARS_EXPERIENCES_3TO5  = 3;
    const YEARS_EXPERIENCES_MORE5 = 4;

    public static function getList()
    {
        return [
            YearsExperiences::YEARS_EXPERIENCES_LESS1 => trans('less_one_year') ,
            YearsExperiences::YEARS_EXPERIENCES_1TO2 => trans('from_1_to_3_years') ,
            YearsExperiences::YEARS_EXPERIENCES_3TO5 => trans('from_3_to_5_years'),
            YearsExperiences::YEARS_EXPERIENCES_MORE5 => trans('more_five_year'),
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
