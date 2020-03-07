<?php

namespace App\Http\Services;

use App\Models\Agency;
use Symfony\Component\HttpFoundation\Request;

class AgencyService
{
    public function __construct()
    {
    }
    public function fillFromRequest(Request $request, $agency = null)
    {
        if (!$agency) {
            $agency = new Agency();
        }
        $agency->fill($request->request->all());
        if ($request->method()=='post') {
         $agency->active = $request->request->get('active', 1);
         }
        $agency->save();

        return $agency;
    }
}
