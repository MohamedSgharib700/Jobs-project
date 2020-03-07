<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Job;
use App\Http\Services\JobService;
use App\Http\Requests\Admin\JobRequest;
use App\Repositories\LocationRepository;
use App\Repositories\IndustryRepository;
use App\Repositories\JobRepository;
use View;

class HomeJobsController extends BaseController
{
    protected $jobService;
    protected $locationRepository;
    protected $industryRepository;
    protected $jobRepository;

    public function __construct(JobService $jobService, LocationRepository $locationRepository, IndustryRepository $industryRepository, JobRepository $jobRepository)
    {
        $this->jobService = $jobService;
        $this->locationRepository = $locationRepository;
        $this->industryRepository = $industryRepository;
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        //$this->authorize("index", Job::class);
        $list = $this->jobRepository->search(request())->paginate(10);
        $list->appends(request()->all());

        return View::make('admin.jobs.index', ['list' => $list]);
    }

    public function create(Job $job)
    {

        request()->request->add(['active' => 1]);
        $industries = $this->industryRepository->search(request())->get();
        $countries = $this->locationRepository->searchFromRequest(request())->get();
        return View::make('admin.jobs.new', ['countries' => $countries, 'industries' => $industries]);

    }

    public function store(JobRequest $request, Job $job)
    {
        $this->jobService->fillJob($request, null, $job);

        return redirect(route('admin.jobs.index'))->with('success', trans('item_added_successfully'));
    }

    public function edit(Job $job)
    {
        request()->request->add(['active' => 1]);

        $industries = $this->industryRepository->search(request())->get();

        $countries = $this->locationRepository->searchFromRequest(request())->get();

        $parentLocationId = optional($job->location->parent)->id ? optional($job->location->parent)->id : $job->location_id;

        request()->query->set('parent', $parentLocationId);

        $cities = $this->locationRepository->searchFromRequest(request())->get();

        $seekerIndustriesArray [] = $job->industry_id;
        request()->request->add(['industries' => $seekerIndustriesArray]);
        $roles = $this->industryRepository->roles(request())->get();

        return view('admin.jobs.edit', ['job' => $job, 'countries' => $countries, 'industries' => $industries, 'cities' => $cities, 'roles' => $roles]);
    }

    public function update(JobRequest $request, Job $job)
    {
        $this->jobService->fillJob($request, $job);
        return redirect(route('admin.jobs.index'))->with('success', trans('item_updated_successfully'));
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
