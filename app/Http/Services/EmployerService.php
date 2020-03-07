<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\EmployerDetails;
use App\Constants\UserTypes;

use Symfony\Component\HttpFoundation\Request;
use Hash;

class EmployerService
{

    public function fillFromRequest(Request $request, $employer = null)
    {
        if (!$employer) {
            $employer = new User();
        }

        $employer->fill($request->request->all());
        if ($request->method()=='post') {
         $employer->active = $request->request->get('active', 1);
         }
        $employer->save();
        return $employer;
    }

    public function fillEmployerDetails(Request $request, $employerDetails = null , $employer = null)
    {
        if (!$employerDetails) {
            $employerDetails = new EmployerDetails();
        }

        $employerDetails->fill($request->request->all());
        $employerDetails->active = $request->request->get('active', 1);
        $employerDetails->save();

        return $employerDetails;
    }


}
