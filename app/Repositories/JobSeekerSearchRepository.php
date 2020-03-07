<?php

namespace App\Repositories;

use App\Models\Job;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use App\Constants\UserTypes ;

class JobSeekerSearchRepository
{

    public function SeekerSearch(User $user, Job $job)
    {
        $users = User::where('type', UserTypes::SEEKER)

        ->whereHas('experiences', function($query) use($job){
            $query->where('years_of_experience', $job->years_of_experience);

        })

        ->whereHas('experiences', function($query) use($job){
            $query->where('career_level', $job->career_level);
        })

        ->whereHas('industries', function($query) use($job){
            $query->where('industry_id', $job->industry_id);
        })

        ->where(function($query) use ($job)  {
            $query->whereHas('workingCountries', function ($query) use ($job) {
                $query->where('country_id', $job->location_id);
            });
            $query->orWhereDoesntHave('workingCountries');
        })
       
        ->orderByDesc("id")->get();


        return $users ;
    }

}
