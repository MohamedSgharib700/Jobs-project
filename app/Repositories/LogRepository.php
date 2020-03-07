<?php

namespace App\Repositories;

use App\Models\Log;
use Symfony\Component\HttpFoundation\Request;
use App\Constants\EventsType ;
class LogRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $logs = Log::query()
            ->when($request->get('message'), function ($logs) use ($request) {
                $message = EventsType::getList()[$request->get('message')];
                return $logs->where( 'message', 'like', $message);
            })
            ->when($request->get('user_id'), function ($logs) use ($request) {
                return $logs->where('user_id', '=', (int)$request->get('user_id'));
            })
            ->when($request->get('object_type'), function ($logs) use ($request) {
                return $logs->where('object_type', '=', $request->get('object_type'));
            })
            ->when($request->get('object_id'), function ($logs) use ($request) {
                return $logs->where('object_id', '=', (int)$request->get('object_id'));
            })
            ->orderBy('id', 'DESC');

        return $logs;
    }
}
