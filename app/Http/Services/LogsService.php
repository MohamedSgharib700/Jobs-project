<?php

namespace App\Http\Services;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Log;

class LogsService
{

    public function fillLog($objectId, $objectType, $message)
    {
        if (auth()->check()) {
            $log = new Log();
            $log->user_id = auth()->user()->id;
            $log->object_id = $objectId;
            $log->object_type = $objectType;
            $log->message = $message;
            $log->save();

            return $log;
        }

        return false;
    }
}
