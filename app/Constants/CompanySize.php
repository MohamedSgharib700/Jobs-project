<?php

namespace App\Constants;

final class CompanySize
{
    const SIZE10 = 1;
    const SIZE20 = 2;
    const SIZE40 = 3;
    const OTHER = 4;

    public static function getList()
    {
        return [
            CompanySize::SIZE10 => trans("from")." " ."10"." ". trans("to")." ". "20" ,
            CompanySize::SIZE20 => trans("from")." " ."20"." ". trans("to")." ". "40" ,
            CompanySize::SIZE40 => trans("from")." " ."31"." ". trans("to")." ". "60" ,
            CompanySize::OTHER => trans("other"),
  
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
