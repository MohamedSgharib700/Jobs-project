<?php

namespace App\Repositories;

use App\Models\Industry;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class IndustryRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $industries = Industry::query()
            ->where('parent_id', null)
            ->orderByDesc("id");

        if ($request->has('name') && !empty($request->get('name'))) {
            $industries->whereHas('translations', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
        }
        if ($request->has('active') && !empty($request->get('active'))) {
            $industries->where('active', $request->get('active'));
        }

        return $industries;
    }

    public function roles(Request $request)
    {
        $industries = Industry::query()->orderByDesc("parent_id");

        if ($request->query->has('industries')) {
            $industries->whereIn('parent_id', $request->query->get('industries'));
        }

        return $industries;
    }

    public function getIndustries()
    {
        $industries = Industry::where('active', '=', '1')
            ->where('parent_id', null)->get();
        return $industries;
    }

    public function jobCount()
    {
        $industries=Industry::withCount('jobs')->orderBy('jobs_count', 'desc')->having('jobs_count', '!=' ,'0')->limit(8)->get();
        
        return $industries;
    }
    public function industriesHaveUsers()
    {
        $industries=Industry::has('users')
                                 ->where('active', '=', '1')
                                 ->where('parent_id', null)->get();
        return $industries;
    }

    public function rolesHaveUsers()
    {
        $roles=Industry::has('usersRoles')
                                 ->where('active', '=', '1')
                                 ->where('parent_id','!=', null)
                                 ->get();
        return $roles;
    }
}
    