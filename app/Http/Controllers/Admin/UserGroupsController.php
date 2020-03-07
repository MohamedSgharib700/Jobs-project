<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Services\UserService;
use App\Models\User;
use App\Repositories\GroupRepository;
use View;
use Illuminate\Http\Request;

class UserGroupsController extends BaseController
{

    protected $userService;
    protected $groupRepository;

    public function __construct(UserService $userService, GroupRepository $groupRepository)
    {
        $this->userService = $userService;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(User $user)
    {
        $this->authorize('userGroups', $user);
        request()->query->set('active', 1);
        $groups = $this->groupRepository->search(request())->get();
        return View::make('admin.users.groups', ['groups' => $groups, 'user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {

        $this->userService->fillUserGroupsFromRequest($request, $user);
        return redirect()->back()->with('success', trans('item_updated_successfully'));

   
    }
}
