<?php

namespace App\Repositories;
use App\Models\User;
use App\Constants\UserTypes;
use Symfony\Component\HttpFoundation\Request;

class EmployerRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $employers = User::where('type' ,'=', UserTypes::OWNER)->orderByDesc("id");
        
        if ($request->has('name') && !empty($request->get('name'))) {
            $names = explode(" ", $request->get('name'));
            $employers->where(function($query) use ($request, $names) {
                $query->where('first_name', 'like', '%' . $request->query->get('name') . '%');
                $query->orwhere('last_name', 'like', '%' . $request->query->get('name') . '%');
                $query->orWhereIn('first_name', $names);
                $query->orWhereIn('last_name', $names);
            });
        }
        if ($request->filled('location_id')) {
              $employers->whereHas('employerDetails.location', function ($query) use ($request) {
                $query->whereIn('id', $request->query->get('location_id'));
            });
        }
         if ($request->filled('active')) {
             
           $employers->where('active', $request->query->get('active'));
         
        }
        if($request->filled('date')) {
            $employers->whereRaw('DATE(created_at) = ?', $request->query->get('date'))  ;
        }

        $employers->with('employerDetails');
        return $employers;
    }

}
