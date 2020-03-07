<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Constants\UserTypes;
use App\Http\Services\UserService;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use View;


class UserController extends BaseController
{
    protected $userService;
    protected $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->authorizeResource(User::class, "user");
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $this->authorize(User::class, "user");
        request()->query->set('type', UserTypes::ADMIN);
        $list = $this->userRepository->search(request())->paginate(30);
        $list->appends(request()->all());
        return View::make('admin.users.index', ['list' => $list]);
    }

    public function create(User $user)
    {
        return View::make('admin.users.new');
    }

    public function store(UserRequest $request)
    {

        $users = $this->userService->fillFromRequest($request);
        return redirect(route('admin.users.index'))->with('success', trans('item_added_successfully'));
    }

    public function edit(User $user)
    {
        return View::make('admin.users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->userService->fillFromRequest($request, $user);
        return redirect(route('admin.users.index'))->with('success', trans('item_updated_successfully'));

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
