<?php

namespace App\Repositories;

use App\Models\CompanyDetails;
use Symfony\Component\HttpFoundation\Request;

class CompanyDetailsRepository
{
    public function search(Request $request)
    {
        $Company = CompanyDetails::query()->orderByDesc("id");


        return $Company;
    }
}
