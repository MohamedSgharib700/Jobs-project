<?php

namespace App\Constants;

final class AgeRange
{
    const AGE18 = 1;
    const AGE26 = 2;
    const AGE31 = 3;
    const AGE36 = 4;
    const AGE41 = 5;
    const AGE46 = 6;
    const AGE51 = 7;
    const AGE56 = 8;

    public static function getList()
    {
        return [
            AgeRange::AGE18 => trans("from")." " ."18"." ". trans("to")." ". "25" ,
            AgeRange::AGE26 => trans("from")." " ."26"." ". trans("to")." ". "30" ,
            AgeRange::AGE31 => trans("from")." " ."31"." ". trans("to")." ". "35" ,
            AgeRange::AGE36 => trans("from")." " ."36"." ". trans("to")." ". "40" ,
            AgeRange::AGE41 => trans("from")." " ."41"." ". trans("to")." ". "45" ,
            AgeRange::AGE46 => trans("from")." " ."46"." ". trans("to")." ". "50" ,
            AgeRange::AGE51 => trans("from")." " ."51"." ". trans("to")." ". "55" ,
            AgeRange::AGE56 => trans("from")." " ."56"." ". trans("to")." ". "60" ,
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
