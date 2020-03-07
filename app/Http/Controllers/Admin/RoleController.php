<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Industry;
use App\Http\Services\RoleService;
use App\Http\Requests\Admin\RoleRequest;
use View;

class RoleController extends BaseController
{
    protected $roleService;

    public function __construct(roleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Industry $industry)
    {
        $list = $industry->children()->paginate(10);

        return View::make('admin.industries.roles.index', ['list' => $list, 'industry' => $industry]);
    }

    public function create(Industry $industry)
    {
        return View::make('admin.industries.roles.new', ['industry' => $industry]);
    }

    public function store(RoleRequest $request, Industry $industry )
    {
        $this->roleService->fillFromRequest($request);
        return redirect(route('admin.industry.roles.index', ['industry' => $industry->id]))->with('success', trans('item_added_successfully'));
    }

    public function edit(Industry $industry, Industry $role)
    {
        return View::make('admin.industries.roles.edit', ['role' => $role, 'industry' => $industry]);
    }

    public function update(RoleRequest $request, Industry $industry, Industry $role)
    {
        $this->roleService->fillFromRequest($request, $role);

        return redirect(route('admin.industry.roles.index', ['industry' => $industry->id]))->with('success', trans('item_updated_successfully'));
    }

    public function destroy(Industry $industry, Industry $role)
    {
        $role->delete();

        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
