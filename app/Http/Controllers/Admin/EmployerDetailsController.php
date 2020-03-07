<?php

namespace App\Http\Controllers\Admin;
use App\Events\UserEditedEvent;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Industry;
use App\Models\EmployerDetails;
use App\Http\Services\EmployerService;
use App\Repositories\LocationRepository;
use App\Repositories\IndustryRepository;
use App\Http\Requests\Admin\EmployerDetailsRequest;
use Illuminate\Http\Request;
use View;
use File;

class EmployerDetailsController extends BaseController
{
    protected $employerService;
    protected $industryRepository;
    protected $locationRepository;

    public function __construct(EmployerService $employerService, IndustryRepository $industryRepository, LocationRepository $locationRepository)
    {
        $this->employerService = $employerService;
        $this->locationRepository = $locationRepository;
        $this->industryRepository = $industryRepository;

    }

    public function create(User $employer)
    {
        $industries = $this->industryRepository->getIndustries();
        $locations = $this->locationRepository->searchFromRequest(request())->get();
        return View::make('admin.employers.details.new', ['employer' => $employer, 'industries' => $industries, 'locations' => $locations]);
    }

    public function store(EmployerDetailsRequest $request, User $employer)
    {
        $this->employerService->fillEmployerDetails($request);
        return redirect(route('admin.employers.index', ['employer' => $employer->id]))->with('success', trans('item_added_successfully'));
    }


    public function edit(User $employer, EmployerDetails $employerDetails)
    {
        $industries = $this->industryRepository->getIndustries();
        $locations = $this->locationRepository->searchFromRequest(request())->get();
        return View::make('admin.employers.details.edit', ['employer' => $employer, 'employerDetails' => $employerDetails, 'industries' => $industries, 'locations' => $locations]);
    }

    public function update(EmployerDetailsRequest $request, User $employer, EmployerDetails $employerDetails)
    {
        $this->employerService->fillEmployerDetails($request, $employerDetails, $employer);
        event(new UserEditedEvent($employer));

        return redirect()->back()->with('success', trans('item_updated_successfully'));
    }

}
