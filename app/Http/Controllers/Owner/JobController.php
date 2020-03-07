<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\BaseController;
use App\Http\Services\JobService;
use App\Models\Job;
use App\Models\User;
use App\Repositories\IndustryRepository;
use App\Repositories\JobRepository;
use App\Repositories\LocationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\JobSeekerSearchRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\Owner\JobRequest;
use View;

class JobController extends BaseController
{
    protected $jobService;
    protected $jobRepository;
    protected $industryRepository;
    protected $locationRepository;
    protected $jobSeekerSearchRepository;

    public function __construct(JobService $jobService, JobRepository $jobRepository, IndustryRepository $industryRepository,
     LocationRepository $locationRepository, SkillRepository $skillRepository, JobSeekerSearchRepository $jobSeekerSearchRepository)
    {
        $this->jobService = $jobService;
        $this->locationRepository = $locationRepository;
        $this->industryRepository = $industryRepository;
        $this->jobRepository = $jobRepository;
        $this->skillRepository = $skillRepository;
        $this->jobSeekerSearchRepository = $jobSeekerSearchRepository;
    }

  
    public function index(User $user)
    {
        $list = $this->jobRepository->search(request())->paginate(10);
        $list->appends(request()->all());
        $companyDetails = $user->employerDetails ;
        return View::make('owner.jobs.index', ['list' => $list, 'companyDetails'=> $companyDetails, 'user' =>$user]);

    }

    public function create(User $user)
    {
        request()->request->add(['active' => 1]);
        $industries = $this->industryRepository->search(request())->get();
        $locations = $this->locationRepository->searchFromRequest(request())->get();
        return View::make('owner.jobs.create', ['user' => $user, 'industries' => $industries, 'locations' => $locations]);
    }

    public function show(User $user, Job $job)
    {
        return View::make('owner.jobs.show', ['user' => $user, 'job'=>$job]);
    }

    public function SeekerSearch(User $user, Job $job)
    {
        $users = $this->jobSeekerSearchRepository->SeekerSearch($user, $job) ;
        return view ('owner.jobs.result',compact('users','job'));
    }

    public function store(JobRequest $request, User $user)
    {
        $this->jobService->fillJob($request);
        return redirect(route('owner.users.jobs.index', ['user' => $user]))->with('success', trans('item_added_successfully'));
    }

    public function addSeekerToJob(Request $request)
    {
        $this->jobService->fillJobToSeeker($request);
        return response()->json('succsessed');
    }


    public function edit(User $user, Job $job)
    {
        request()->request->add(['active' => 1]);
        $industries = $this->industryRepository->search(request())->get();

        $countries = $this->locationRepository->searchFromRequest(request())->get();

        $parentLocationId = optional(@$job->location->parent)->id ? optional(@$job->location->parent)->id : $job->location_id;

        request()->query->set('parent', $parentLocationId);

        $cities = $this->locationRepository->searchFromRequest(request())->get();

        $seekerIndustriesArray [] = $job->industry_id;
        request()->request->add(['industries' => $seekerIndustriesArray]);
        $roles = $this->industryRepository->roles(request())->get();


        return view('owner.jobs.edit', ['job' => $job, 'industries' => $industries, 'countries' => $countries, 'cities' => $cities, 'user' => $user, 'roles' => $roles]);
    }

    public function update(JobRequest $request, User $user, Job $job)
    {

        $this->jobService->fillJob($request, $job);
        return redirect(route('owner.users.jobs.index', ['user' => $user]))->with('success', trans('item_added_successfully'));
    }

    public function destroy(User $user, Job $job)
    {
        $job->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
