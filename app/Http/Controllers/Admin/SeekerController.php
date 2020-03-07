<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserTypes;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\ImportRequest;
use App\Models\User;
use App\Http\Services\SeekerService;
use App\Http\Services\UploaderService;
use App\Models\UserSkill;
use App\Repositories\LogRepository;
use App\Repositories\SeekerRepository;
use App\Repositories\IndustryRepository;
use App\Repositories\LocationRepository;
use App\Http\Requests\Admin\SeekerRequest;
use Illuminate\Http\Request;
use View;
use File;

use App\Http\Requests;

class SeekerController extends BaseController
{
    protected $seekerService;
    protected $seekerRepository;
    protected $locationRepository;
    protected $uploadService;
    protected $industryRepository;
    protected $logRepository;

    public function __construct(SeekerService $seekerService, SeekerRepository $seekerRepository, UploaderService $uploadService, LocationRepository $locationRepository, IndustryRepository $industryRepository, LogRepository $logRepository)
    {
        $this->seekerService = $seekerService;
        $this->seekerRepository = $seekerRepository;
        $this->locationRepository = $locationRepository;
        $this->uploadService = $uploadService;
        $this->industryRepository = $industryRepository;
        $this->logRepository = $logRepository;
    }

    public function index()
    {
        $this->authorize("seekersIndex", User::class);
        $list = $this->seekerRepository->search(request())->paginate(10);
        $list->appends(request()->all());

        $request = new Request();
        $request->replace(['active' => 1]);
        $industries = $this->industryRepository->search($request)->get();
        $countries = $this->locationRepository->searchFromRequest(request())->get();

        return View::make('admin.seekers.index', ['list' => $list, 'industries' => $industries, 'countries' => $countries]);
    }

    public function create()
    {
        $this->authorize("seekersCreate", User::class);
        request()->query->set('active', 1);
        $countries = $this->locationRepository->searchFromRequest(request())->get();

        return View::make('admin.seekers.new', ['countries' => $countries]);
    }

    public function store(SeekerRequest $request)
    {
        $user = $this->seekerService->fillPersonalData($request);

        $request->request->add(['user_id' => $user->id]);
        $this->seekerService->fillSeekerDetails($request);

        return redirect(route('admin.seeker.details.create', ['seeker' => $user->id]))->with('success', trans('item_added_successfully'));
    }

    public function edit(User $seeker)
    {
        $this->authorize("seekersUpdate", [User::class, $seeker]);
        $seekerDetails = $seeker->details;
        $seekerExperiences = $seeker->experiences;
        $countries = $this->locationRepository->searchFromRequest(request())->get();

        return View::make('admin.seekers.edit', ['seeker' => $seeker, 'seekerDetails' => $seekerDetails, 'seekerExperiences' => $seekerExperiences, 'countries' => $countries]);
    }

    public function update(SeekerRequest $request, User $seeker)
    {
        $this->seekerService->fillPersonalData($request, $seeker);

        $seekerDetails = $seeker->details;
        $request->request->add(['user_id' => $seeker->id]);
        $this->seekerService->fillSeekerDetails($request, $seekerDetails);

        return redirect()->back()->with('success', trans('item_updated_successfully'));
    }

    public function destroy(User $seeker)
    {

        $this->authorize("seekersDelete", [User::class, $seeker]);
        if ($seeker->details){
            $this->uploadService->deleteFile($seeker->details->cv);
        }

        $seeker->delete();

     if (request('redirectSeekers')=="1") {
         return redirect()->back()->with('success', trans('item_deleted_successfully'));
         
        }else{
          return redirect(route('admin.seekers.index'))->with('success', trans('item_deleted_successfully'));
         
        }
   
    }

    public function import()
    {
        return View::make('admin.seekers.import');
    }

    public function storeImport(ImportRequest $request)
    {
        return $this->seekerService->import($request);
    }

    public function logs(User $user)
    {
        request()->request->add(['object_id' => $user->id, 'object_type' => "App\Models\User"]);
        $list = $this->logRepository->search(request())->paginate(10);
        $list->appends(request()->all());

        return View::make('admin.seekers.logs', ['list' => $list, 'user_name' => $user->first_name . " " . $user->last_name, 'seeker' => $user]);
    }
}
