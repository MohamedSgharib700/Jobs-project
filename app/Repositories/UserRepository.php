<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class UserRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $users = User::orderByDesc("id")
            ->when($request->has('type'), function ($users) use ($request) {
                return $users->where('type', '=', (int)$request->get('type'));
            });
        if ($request->filled('active')) {
            $users->where('active', $request->query->get('active'));
        }
        return $users;
    }


    public function Charts(Request $request)
    {
        $users = User::select(DB::raw('count(id) as `number`'), DB::raw("DATE_FORMAT(created_at, '%d') as 'day'"))

            ->when($request->has('type'), function ($users) use ($request) {
                return $users->where('type', '=', (int)$request->get('type'));
            });

        if ($request->has('from_date') && $request->get('from_date') != "") {
            $users->where('created_at', '>=', $request->get('from_date'));
        }
        if ($request->has('to_date') && $request->get('to_date') != "") {
            $users->where('created_at', '<=', $request->get('to_date'));
        }
        $users->groupby('day');

        return $users;
    }
}
