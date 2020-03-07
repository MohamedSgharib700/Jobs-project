<?php

namespace App\Http\Controllers\Owner;

use App\Models\Location;
use App\Models\User;
use App\Models\EmployerDetails;
use App\Http\Services\EmployerService;
use App\Repositories\EmployerRepository;
use App\Repositories\IndustryRepository;
use App\Repositories\LocationRepository;
use App\Http\Requests\Owner\EmployerDetailsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use View ;

class EmployerDetailsController extends BaseController
{
    protected $companyService;
    protected $companyRepository;

    public function __construct(EmployerService $companyService, EmployerRepository $companyRepository ,IndustryRepository $industryRepository, LocationRepository $locationRepository)
    {
        $this->companyService = $companyService;
        $this->companyRepository = $companyRepository;
        $this->industryRepository = $industryRepository;
        $this->locationRepository = $locationRepository;
    }


    public function create(User $employer)
    {
        $industries = $this->industryRepository->getIndustries();
        $locations = Location::all();
        return View::make('owner.companies.create' , ['locations' => $locations, 'industries' => $industries,'employer' => $employer]);
    }
 
    public function store(EmployerDetailsRequest $request,User $employer)
    {
        $this->companyService->fillEmployerDetails($request);
        return redirect(route('owner.users.companies.create', ['employer' => $employer->id]))->with('message' , trans('signed_successfully'));
    }

   
    public function edit(User $user , EmployerDetails $employerDetails)
    {
       $industries = $this->industryRepository->getIndustries();
       $locations = Location::all();
       return View::make('owner.companies.edit', ['employer' => $user, 'employerDetails' => $employerDetails, 'industries' => $industries, 'locations' => $locations]);
    }

    public function update(EmployerDetailsRequest $request, User $user, EmployerDetails $employerDetails)
    {
        $this->companyService->fillEmployerDetails($request, $employerDetails, $user);

        return redirect()->back()->with('message' , trans('updated_successfully') );
    }
}
