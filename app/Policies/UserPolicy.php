<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->hasAccess("admin.users.index");
    }

    public function create(User $user)
    {
        return $user->hasAccess("admin.users.create");
    }

    public function update(User $user, User $model)
    {
        return $user->hasAccess("admin.users.update");
    }

    public function delete(User $user, User $model)
    {
        return $user->hasAccess("admin.users.destroy");
    }

    public function userGroups(User $user)
    {
        return $user->hasAccess("admin.users.group.index") ;
    }

    public function seekersIndex(User $user)
    {
        return $user->hasAccess("admin.seekers.index");
    }

    public function seekersCreate(User $user)
    {
        return $user->hasAccess("admin.seekers.create");
    }

    public function seekersUpdate(User $user, User $object)
    {
        return $user->hasAccess("admin.seekers.update");
    }

    public function seekersDelete(User $user, User $object)
    {
        return $user->hasAccess("admin.seekers.destroy");
    }

    public function employersIndex(User $user)
    {
        return $user->hasAccess("admin.employers.index");
    }

    public function employersCreate(User $user)
    {
        return $user->hasAccess("admin.employers.create");
    }

    public function employersUpdate(User $user, User $object)
    {
        return $user->hasAccess("admin.employers.update");
    }

    public function employersDelete(User $user, User $object)
    {
        return $user->hasAccess("admin.employers.destroy");
    }
}
