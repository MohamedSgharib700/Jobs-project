<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GroupPermission;
use App\Constants\UserTypes;

use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPermissionPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if (!$user->isTypeOf(UserTypes::ADMIN)) {
            return true;
        }
    }

    public function index(User $user)
    {
        return $user->hasAccess("admin.group.permissions.index");
    }

    
}
