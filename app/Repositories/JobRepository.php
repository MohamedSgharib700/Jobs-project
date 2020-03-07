<?php

namespace App\Repositories;

use App\Models\Job;
use Symfony\Component\HttpFoundation\Request;

class JobRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $jobs = Job::query()
           
            ->orderByDesc("id");

        if ($request->has('active') && !empty($request->get('active'))) {
            $jobs->where('active', $request->get('active')) ;
        }
                if($request->filled('country_id')) {
            $agency->whereHas('location.parent', function ($query) use ($request) {
                $query->whereIn('id',$request->query->get('country_id'));
            });
        }

        return $jobs;
    }

}
