<?php

namespace App\Repositories;

use App\Models\Skill;
use Symfony\Component\HttpFoundation\Request;

class SkillRepository
{
    public function search(Request $request)
    {
        $skills = Skill::query()->orderByDesc("id");

        return $skills;
    }
}
