<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLoggedEvent;
use App\Http\Controllers\BaseController;
use App\Http\Services\AuthService;
use App\Models\User;
use Carbon\Carbon;
use View;
use App\Http\Requests;
use Auth;
use App\Http\Requests\Admin\LoginAttemptRequest;


class AuthController extends BaseController
{

    public function attempt(LoginAttemptRequest $request, AuthService $authService)
    {
        if (!$authService->attempt($request)) {
            session()->flash('error', trans('invalid_credentials'));

            return redirect()->back();
        }

        /** @var User $user */
        $user = auth()->user();
        event(new UserLoggedEvent($user));

        if (!$user->token || $user->token_expires_at < Carbon::now()) {
            $token = $user->createToken('User Personal Token #' . $user->id);
            $user->token = $token->accessToken;
            $user->token_expires_at = $token->token->expires_at;
            $user->save();
        }

        return redirect()->intended();
    }

    public function logout()
    {
        Auth::logout();
        Session()->flush();

        return redirect('/');
    }

    public function login()
    {
        if(auth()->check()){
            return redirect(route('admin.home.index'));
        }
        return View::make('admin.auth.login');
    }

 
}
