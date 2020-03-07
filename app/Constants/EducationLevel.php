<?php

namespace App\Constants;

final class EducationLevel
{
    const NOT_SPECIFIED = 1;
    const HIGH_SCHOOL_OR_LOWER = 2;
    const VOCATIONAL_EDUCATION = 3;
    const BACHELORS_DEGREE = 4;
    const DIPLOMA = 5;
    const MASTER_DEGREE = 6;
    const DOCTORATE_DEGREE = 7;

    public static function getList()
    {
        return [
            EducationLevel::NOT_SPECIFIED => trans("not_specified"),
            EducationLevel::HIGH_SCHOOL_OR_LOWER => trans("high_school_or_lower"),
            EducationLevel::VOCATIONAL_EDUCATION => trans("vocational_education"),
            EducationLevel::BACHELORS_DEGREE => trans("bachelors_degree"),
            EducationLevel::DIPLOMA => trans("diploma"),
            EducationLevel::MASTER_DEGREE => trans("masters_degree"),
            EducationLevel::DOCTORATE_DEGREE => trans("doctorate_degree"),
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
