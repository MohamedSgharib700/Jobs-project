<?php

namespace App\Http\Services;

use App\Models\Industry;
use Symfony\Component\HttpFoundation\Request;
use File;

class RoleService
{
    public function fillFromRequest(Request $request, $role = null)
    {
        if (!$role) {
            $role = new Industry();
        }

        $role->fill($request->request->all());
        if ($request->method()=='post') {
         $role->active = $request->request->get('active', 1);
         }
        $role->save();

        return $role;
    }
}
