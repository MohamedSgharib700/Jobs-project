<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Location;
use App\Http\Services\EmployerService;
use App\Repositories\EmployerRepository;
use App\Repositories\LocationRepository;
use App\Http\Requests\Admin\EmployerRequest;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;
use View;
use File;

class EmployerController extends BaseController
{
    protected $employerService;
    protected $employerRepository;
    protected $logRepository;

    public function __construct(EmployerService $employerService, EmployerRepository $employerRepository, LocationRepository $locationRepository, LogRepository $logRepository)
    {
        $this->authorizeResource(User::class, "employer");
        $this->employerService = $employerService;
        $this->employerRepository = $employerRepository;
        $this->locationRepository = $locationRepository;
        $this->logRepository = $logRepository;

    }

    public function index(Request $request)
    {
        $this->authorize("employersIndex", User::class);
        $list = $this->employerRepository->search(request())->paginate(10);
        $list->appends(request()->all());
        $locations = $this->locationRepository->searchFromRequest(request())->get();

        return View::make('admin.employers.index', ['list' => $list, 'locations' => $locations]);
    }

    public function create(User $employer)
    {
        $this->authorize("employersCreate", User::class);
        $locations = $this->locationRepository->searchFromRequest(request())->get();
        return View::make('admin.employers.new', ['locations' => $locations]);
    }

    public function store(EmployerRequest $request)
    {
        $user = $this->employerService->fillFromRequest($request);
        return redirect(route('admin.employer.details.create', ['employer' => $user->id]))->with('success', trans('item_added_successfully'));
    }

    public function edit(User $employer)
    {
        $this->authorize("employersUpdate", [User::class, $employer]);
        $employerDetails = $employer->employerDetails;
        $locations = $this->locationRepository->searchFromRequest(request())->get();
        return View::make('admin.employers.edit', ['employer' => $employer, 'employerDetails' => $employerDetails, 'locations' => $locations]);
    }

    public function update(EmployerRequest $request, User $employer)
    {
        $this->employerService->fillFromRequest($request, $employer);
        $employerDetails = $employer->employerDetails;
        return redirect()->back()->with('success', trans('item_updated_successfully'));

    }

    public function destroy(User $employer)
    {
        $this->authorize("employersDelete", [User::class, $employer]);
        $employer->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }

    public function logs(User $employer)
    {
        request()->request->add(['object_id' => $employer->id, 'object_type' => "App\Models\User"]);
        $list = $this->logRepository->search(request())->paginate(10);
        $list->appends(request()->all());
        $employerDetails = $employer->employerDetails;
        return View::make('admin.employers.logs', ['list' => $list,'employerDetails' => $employerDetails,'employer'=>$employer, 'user_name' => $employer->first_name." ".$employer->last_name]);
    }
}
