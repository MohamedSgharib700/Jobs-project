<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Group;

use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Services\GroupPermissionService;
use View;
use App\Models\GroupPermission ;

class GroupPermissionController extends BaseController
{
    protected $groupPermissionService;
    protected $permissionRepository;

    public function __construct(GroupPermissionService $groupPermissionService, PermissionRepository $permissionRepository)
    {
        $this->groupPermissionService = $groupPermissionService;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Group $group)
    {
        $this->authorize("index", GroupPermission::class);
        request()->query->set('active', 1);
        $permissions = $this->permissionRepository->search(request())->get();
        return View::make('admin.groups.permissions', ['permissions' => $permissions, 'group' => $group]);
    }

    public function store(Request $request, Group $group)
    {
        $this->groupPermissionService->fillFromRequest($request, $group);
        return redirect()->back()->with('success', trans('item_updated_successfully'));
    }
}
