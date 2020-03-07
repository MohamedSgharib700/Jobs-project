<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agency;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgencyPolicy
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
        return $user->hasAccess("admin.agencies.index");
    }

    public function create(User $user)
    {
        return $user->hasAccess("admin.agencies.create");
    }

    public function update(User $user, Agency $agency)
    {
        return $user->hasAccess("admin.agencies.update");
    }

    public function delete(User $user, Agency $agency)
    {
        return $user->hasAccess("admin.agencies.destroy");
    }
}
