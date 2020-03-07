<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if (!$user->isTypeOf(UserTypes::ADMIN)) {
            return false;
        }
    }

    public function index(User $user)
    {
        return $user->hasAccess("admin.permissions.index");
    }

   
    public function update(User $user, Permission $permission)
    {
        return $user->hasAccess("admin.permissions.update");
    }

  
}
