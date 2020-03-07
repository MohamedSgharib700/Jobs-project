<?php

namespace App\Repositories;

use App\Models\Agency;
use App\Models\Location;
use Symfony\Component\HttpFoundation\Request;

class AgencyRepository
{
    public function searchFromRequest($request)
    {
        $agency = Agency::orderBy('id', 'DESC');       
     
        if($request->filled('name')) {
            $agency->where('name', 'like', '%' . $request->query->get('name') . '%');                  
        }
        
        if($request->filled('active')) {
            $agency->where('active', $request->query->get('active'));  
        }

        if($request->filled('country_id')) {
            $agency->whereHas('location.parent', function ($query) use ($request) {
                $query->whereIn('id',$request->query->get('country_id'));
            });
        }

        if($request->filled('date')) {
            $agency->whereRaw('DATE(created_at) = ?', $request->query->get('date'))  ;
        }

        return $agency;
    }
   
}
