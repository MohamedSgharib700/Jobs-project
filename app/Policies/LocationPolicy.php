<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
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
        return $user->hasAccess("admin.locations.index");
    }
    
    public function view(User $user, Location $location)
    {
        return $user->hasAccess("admin.locations.show");
    }

    public function create(User $user)
    {
        return $user->hasAccess("admin.locations.create");
    }

    public function update(User $user, Location $location)
    {
        return $user->hasAccess("admin.locations.update");
    }

    public function delete(User $user, Location $location)
    {
        return $user->hasAccess("admin.locations.destroy");
    }
}
