<?php

namespace App\Http\Services;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class UserService
{

    public function fillFromRequest(Request $request, $user = null)
    {
        if (!$user) {
            $user = new User();
        }

        $user->fill($request->request->all());
        if ($request->method() == 'post') {
            $user->active = $request->request->get('active', 1);
        }
        $user->save();
        return $user;
    }

    /**
     * @param Request $request
     * @param null $user
     * @return bool|null
     */
    public function fillUserGroupsFromRequest(Request $request, $user = null)
    {
        if (!$user) {
            return false;
        }
        $user->groups()->sync($request->input("groups"));
        return $user;
    }
}
