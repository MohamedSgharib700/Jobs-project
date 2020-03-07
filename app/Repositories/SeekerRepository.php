<?php

namespace App\Repositories;

use App\Constants\UserTypes;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class SeekerRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $seekers = User::query()->where('type', UserTypes::SEEKER)->orderByDesc("id");

        if ($request->has('countries') && $request->get('countries') !="") {
            $seekers->where(function($query) use ($request) {
                $query->whereHas('workingCountries', function ($query) use ($request) {
                    $query->whereIn('country_id', $request->query->get('countries'));
                });
                $query->orWhereDoesntHave('workingCountries');
            });
        }
        if ($request->has('cv') && $request->get('cv') !="") {

            $seekers->where(function($query) use ($request) {
                if ($request->get('cv') == 1) {
                    $query->whereHas('details', function ($query) use ($request) {
                        $query->where('cv', '<>', null );
                    });
                }
                if ($request->get('cv') == 0) {
                    ($query->whereHas('details', function ($query) use ($request) {
                        $query->where('cv', null);
                    })->orWhereDoesntHave('details'));
                }
            });
        }

        if ($request->has('gender') && $request->get('gender') !="") {
            $seekers->where('gender', $request->get('gender'));
        }
        if ($request->has('active') && $request->get('active') !="") {
            $seekers->where('active', $request->get('active'));
        }
        if ($request->has('age') && $request->get('age') !="") {
            $seekers->whereIn('age', $request->query->get('age'));
        }
        if ($request->has('from_date') && $request->get('from_date') !="") {
            $seekers->whereRaw('DATE(created_at) >= ?', $request->get('from_date'));
        }
        if ($request->has('to_date') && $request->get('to_date') !="") {
            $seekers->whereRaw('DATE(created_at) <= ?', $request->get('to_date'));
        }
        if ($request->filled('industries')) {
            $seekers->whereHas('industries', function ($query) use ($request) {
                $query->whereIn('industry_id', $request->query->get('industries'));
            });
        }
        if ($request->has('name') && !empty($request->get('name'))) {
            $names = explode(" ", $request->get('name'));
            $seekers->where(function($query) use ($request, $names) {
                $query->where('first_name', 'like', '%' . $request->query->get('name') . '%');
                $query->orwhere('last_name', 'like', '%' . $request->query->get('name') . '%');
                $query->orWhereIn('first_name', $names);
                $query->orWhereIn('last_name', $names);
            });
        }
        

        return $seekers;
    }
}
