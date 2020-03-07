<?php

namespace App\Repositories;

use App\Models\Group;
use Symfony\Component\HttpFoundation\Request;

class GroupRepository
{
    public function search(Request $request)
    {
        $groups = Group::query()
            ->orderByDesc("id")
            ->when($request->has('active'), function ($groups) use ($request) {
                return $groups->where('active', 1);
            });

        if ($request->has('name') && !empty($request->get('name'))) {
            $groups->whereHas('translations', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
        }

        return $groups;
    }
}
