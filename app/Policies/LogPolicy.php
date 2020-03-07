<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Log;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogPolicy
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
        return $user->hasAccess("admin.logs.index");
    }

   

  
}
