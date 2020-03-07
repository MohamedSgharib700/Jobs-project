<?php

namespace App\Constants;

use phpDocumentor\Reflection\Types\Self_;

final class ObjectTypes
{
    const USER = 'App\Models\User';
    const LOCATION = 'App\Models\Location';
    const INDUSTRY = 'App\Models\Industry';
    const BLOG = 'App\Models\Blog';
    const AGENCY = 'App\Models\Agency';

    const EMPLOYER_DETAILS = 'App\Models\EmployerDetails';

    const PERMISSION = 'App\Models\Permission';
    const GROUP = 'App\Models\Group';

    

    public static function getKeyList()
    {
        return array_keys(self::getList());
    }

    public static function getList()
    {
        return [

            ObjectTypes::USER => trans("users"),
            ObjectTypes::LOCATION => trans("location"),
            ObjectTypes::INDUSTRY => trans("industry"),
            ObjectTypes::BLOG => trans("blog"),
            ObjectTypes::AGENCY => trans("agency"),
            ObjectTypes::EMPLOYER_DETAILS => trans("employer_details"),
            ObjectTypes::PERMISSION => trans("permission"),
            ObjectTypes::GROUP => trans("group"),
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
