<?php

namespace App\Constants;

final class EventsType
{
    const CREATED                  = 1;
    const UPDATED                  = 2;
    const DELETED                  = 3;
    const CHANGEDSTATUSTOACTIVE    = 4;
    const CHANGEDSTATUSTODISABLED  = 5;
    const LOGGED                   = 6;

    public static function getList()
    {
        return [
            EventsType::CREATED                  => "created",
            EventsType::UPDATED                  => "updated",
            EventsType::DELETED                  => "deleted",
            EventsType::CHANGEDSTATUSTOACTIVE    => "changed_status_to_active",
            EventsType::CHANGEDSTATUSTODISABLED  => "changed_status_to_disabled",
            EventsType::LOGGED                   => "Logged",
        ];
    }

}
