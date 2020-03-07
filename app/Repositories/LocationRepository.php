<?php

namespace App\Repositories;

use App\Models\Location;
use Symfony\Component\HttpFoundation\Request;

class LocationRepository
{
    public function searchFromRequest($request)
    {

        $location = Location::orderBy('id', 'DESC')
            ->when($request->has('parent'), function ($location) use ($request) {

                if (old('parent')) {
                    $request->merge(['parent' => old('parent')]);
                }

                return $location->where('parent_id', '=', (int)$request->get('parent'));
            }, function ($location) use ($request) {
                return $location->where('parent_id', '=', NULL);
            })
            ->when($request->filled('name'), function ($location) use ($request) {
                return $location->whereHas('translations', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
            })
            ->when($request->has('desired'), function ($location) use ($request) {
                return $location->where('active', 1);
            })
            ->when($request->filled('active'), function ($location) use ($request) {
                return $location->where('active', 1);
            });


        return $location;
    }


    public function searchCity($request)
    {

        $location = Location::orderBy('id', 'DESC')
            ->where('parent_id', '!=', NULL)
            ->when($request->filled('name'), function ($location) use ($request) {
                return $location->whereHas('translations', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
            })
            ->when($request->filled('active'), function ($location) use ($request) {
                return $location->where('active', 1);
            });


        return $location;
    }
    public function workingCountriesHaveUsers()
    {
        $workingCountries=Location::has('workingCountries')
                                  ->where('parent_id', '=', NULL)
                                  ->where('active', '=', '1')
                                  ->get();
        return $workingCountries;
    }
        public function residenceCountriesHaveUsers()
    {
        $residenceCountries=Location::has('residence')
                                  ->where('parent_id', '=', NULL)
                                  ->where('active', '=', '1')
                                  ->get();
        return $residenceCountries;
    }
}
