<?php

namespace App\Policies;

use App\Models\User;
use App\Models\industry;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class industryPolicy
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
        return $user->hasAccess("admin.industries.index");
    }

    public function create(User $user)
    {
        return $user->hasAccess("admin.industries.create");
    }

    public function update(User $user, Industry $industry)
    {
        return $user->hasAccess("admin.industries.update");
    }

    public function delete(User $user, Industry $industry)
    {
        return $user->hasAccess("admin.industries.destroy");
    }
}
