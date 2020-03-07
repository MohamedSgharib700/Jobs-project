<?php

namespace App\Http\Controllers\Web;

use App\Constants\UserTypes;
use App\Http\Controllers\BaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Routing\Redirector as RedirectorAlias;
use View;
use Auth;
use App\Http\Services\UserService;
use App\Http\Requests\Web\UserRequest;
use App\Http\Requests\Web\ChangePasswordRequest;

class UserController extends BaseController
{

    protected $userService;
    protected $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return View::make('web.user.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $this->userService->fillFromRequest($request, auth()->user());
        return redirect(route('profile.edit'))->with('success', trans('item_updated_successfully'));
    }

    /**
     * Update user password
     * @return \Illuminate\Contracts\View\View
     */
    public function editPassword()
    {
        return View::make('web.user.password', ['user' => auth()->user()]);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|RedirectorAlias
     */
    public function updatePassword(ChangePasswordRequest $request)
    {
        if (!$this->userService->fillChangePasswordFromRequest($request, auth()->user())) {
            return redirect()->back()->with('error', trans('please_enter_correct_password'));
        }

        return redirect()->back()->with('success', trans('password_updated_successfully'));
    }

    public function myProfile()
    {
        request()->query->set('active', 1);
        request()->query->set('type', UserTypes::OWNER);
        $OwnersCount = $this->userRepository->search(request())->count();

        request()->query->set('type', UserTypes::SEEKER);
        $seekersCount = $this->userRepository->search(request())->count();

        return View::make('web.user.profile', ['user' => auth()->user(), 'OwnersCount' => $OwnersCount, 'seekersCount' => $seekersCount]);
    }

}
