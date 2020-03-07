<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;
use App\Constants\UserTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
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
        return $user->hasAccess("admin.blog.index");
    }

    public function create(User $user)
    {
        return $user->hasAccess("admin.blog.create");
    }

    public function update(User $user, Blog $blog)
    {
        return $user->hasAccess("admin.industries.update");
    }

    public function delete(User $user, Blog $blog)
    {
        return $user->hasAccess("admin.blog.destroy");
    }
}
