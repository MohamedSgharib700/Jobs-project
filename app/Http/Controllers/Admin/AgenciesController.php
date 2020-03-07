<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AgencyRequest;
use App\Http\Requests\Admin\LocationRequest;
use App\Http\Services\AgencyService;
use App\Repositories\AgencyRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Location;

class AgenciesController extends BaseController
{
    
    protected $agencyService;
    private $agencyRepository;
    private $locationRepository;

    public function __construct(AgencyService $agencyService, AgencyRepository $agencyRepository, LocationRepository $locationRepository)
    {
        $this->authorizeResource(Agency::class, "agency");
        $this->agencyService = $agencyService;
        $this->agencyRepository = $agencyRepository;
        $this->locationRepository = $locationRepository;
    }

    public function index(Request $request)
    {
        $this->authorize("index", Agency::class);
        $list = $this->agencyRepository->searchFromRequest(request())->paginate(10);
        $list->appends(request()->all());
        $countries =$this->locationRepository->searchFromRequest(request())->get(); 
        return view('admin.agencies.index',compact('list', 'countries'));
    }

    public function create()
    {
        request()->query->set('active', 1);
        $countries = $this->locationRepository->searchFromRequest(request())->get();
        return view('admin.agencies.new',compact('countries'));
    }

    public function store(AgencyRequest $request)
    {
        $this->agencyService->fillFromRequest($request);
        return redirect(route('admin.agencies.index'))->with('success', trans('item_added_successfully'));
    }
    
    public function edit(Agency $agency)
    {
        $countries = $this->locationRepository->searchFromRequest(request())->get();
     
        request()->query->set('parent', $agency->location->parent->id);
     
        $cities = $this->locationRepository->searchFromRequest(request())->get();
        return view('admin.agencies.edit',compact('agency','countries','cities'));
    }

    public function update(AgencyRequest $request, Agency $agency)
    {
        $this->agencyService->fillFromRequest($request, $agency);
        return redirect(route('admin.agencies.index'))->with('success', trans('item_updated_successfully'));
    }

    public function destroy(Agency $agency)
    {
        $agency->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
