<?php

namespace App\Http\Controllers\Web;

use App\Events\UserLoggedEvent;
use App\Http\Controllers\BaseController;
use App\Http\Services\AuthService;
use App\Models\User;
use App\Repositories\LocationRepository;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Password;
use Str;
use View;
use App\Http\Requests;
use App\Http\Requests\Web\ForgotPasswordRequest;
use App\Http\Requests\Web\ConfirmResetPasswordRequest;
use Auth;
use App\Http\Requests\Web\LoginAttemptRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Constants\UserTypes;

class AuthController extends BaseController
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->middleware('guest', ['except' => ['logout']]);
        $this->locationRepository = $locationRepository;
    }

    public function redirectTo()
    {

        switch (Auth::user()->type) {
            case UserTypes::ADMIN :
                return redirect()->route('admin.home.index');
                break;
            case  UserTypes::SEEKER :
                return redirect()->route('web.home.index');
                break;
            case  UserTypes::OWNER :
                return redirect()->route('owner.companies.create');
                break;
            default:
                return redirect(route('web.home.index'));
                break;
        }
    }

    public function attempt(LoginAttemptRequest $request, AuthService $authService)
    {
        if (!$authService->attempt($request)) {
            session()->flash('error', trans('invalid_credentials'));
            return redirect()->back();
        }

        $user = auth()->user();
        event(new UserLoggedEvent($user));

        if (!$user->token || $user->token_expires_at < Carbon::now()) {
            $token = $user->createToken('User Personal Token #' . $user->id);
            $user->token = $token->accessToken;
            $user->token_expires_at = $token->token->expires_at;
            $user->save();
        }
        return $this->redirectTo();
    }

    public function logout()
    {
        Auth::logout();
        Session()->flush();
        return redirect('/');
    }

    public function login()
    {
        return View::make('web.auth.login');
    }

    public function register(Request $request)
    {
        if (!$request->has('type')) {
            return redirect()->back()->with(['alert' => trans('choose_type_please')]);
        }
        $type = $request->get('type');
        $countries=$this->locationRepository->searchFromRequest(request())->get();

        return View::make('web.auth.register', compact(['type','countries']));
    }

    public function type()
    {
        return View::make('web.auth.type');
    }

    public function registerAction(RegisterRequest $request, AuthService $authService)
    {
        $user = $authService->registerFromRequest($request);
        auth()->login($user);
        session()->flash('success', trans('register_success_message'));
        return $this->redirectTo();
    }

    public function reset(Request $request)
    {
        if ($request->query->has('token')) {
            return View::make('web.auth.resetter');
        }
        return View::make('web.auth.reset');
    }

    public function sendReset(ForgotPasswordRequest $request)
    {
        Password::broker()->sendResetLink(
            $request->only('email')
        );
        session()->flash('success', trans('passwords.sent'));
        return redirect()->back();
    }

    public function resetPassword(ConfirmResetPasswordRequest $request)
    {
        $response = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
                Auth::guard()->login($user);
            }
        );

        if ($response != Password::PASSWORD_RESET) {
            return redirect()->back()->with('error', trans($response));
        }

        return redirect('/');
    }

    public function emailValidation(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users'
        ]);
    }

}
