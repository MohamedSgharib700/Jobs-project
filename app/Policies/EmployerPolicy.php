<?php

namespace App\Policies;

use App\Models\User;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
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
        return $user->hasAccess("admin.employers.index");
    }

    public function create(User $user)
    {
        return $user->hasAccess("admin.employers.create");
    }

    public function update(User $user, User $employer)
    {
        return $user->hasAccess("admin.employers.update");
    }

    public function delete(User $user, User $employer)
    {
        return $user->hasAccess("admin.employers.destroy");
    }
}
