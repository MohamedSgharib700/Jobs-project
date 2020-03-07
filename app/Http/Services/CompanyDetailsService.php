<?php

namespace App\Http\Services;

use App\Models\CompanyDetails;
use Symfony\Component\HttpFoundation\Request;

class CompanyDetailsService
{

    public function fillFromRequest(Request $request, $company = null)
    {
        if (!$company) {
            $company = new CompanyDetails();
        }
        $company->fill($request->request->all());
        $company->save();
        return $company;
    }

}
