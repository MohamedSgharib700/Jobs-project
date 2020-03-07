<?php

namespace App\Http\Services;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use App\Constants\UserTypes ;
class AuthService
{

    public function attempt(Request $request)
    {
        return auth()->attempt(
            ['email' => $request->request->get('email'), 'password' => $request->request->get('password')]
        );
    }

    public function registerFromRequest(Request $request, $user = null)
    {
        if (!$user) {
            $user = new User();
        }
        $user->fill($request->request->all());
        $user->name = $request->first_name .'  '.$request->last_name;
        $user->active = 1;
        $user->save();
        return $user;
    } 
}
