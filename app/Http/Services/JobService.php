<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Skill;
use App\Models\Job;
use App\Models\JobSeekers;
use App\Constants\UserTypes;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;
use File;

class JobService
{
    protected $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }


    public function fillJob(Request $request, $job = null)
    {
        if (!$job) {
            $job = new Job();
        }
        $job->fill($request->all());

        $job->location_id = $request->input('city_id');

        if ($request->input('city_id') == null) {
            $job->location_id = $request->input('country_id');
        }
        
        $job->save();
        
        if (!empty($request->has('roles'))) {
            $job->roles()->sync($request->input("roles"));
        }
        return $job;
    }


    public function fillJobToSeeker(Request $request, $jobSeekers = null)
    {
     
        if (! $jobSeekers) {
            $jobSeekers = new JobSeekers();
        }
        $jobSeekers->fill($request->all());
        $jobSeekers->save();
        
        return $jobSeekers;
    
    }

}
