<?php

namespace App\Http\Controllers\Admin;

use App\Events\LocationEditedEvent;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\LocationRequest;
use App\Http\Services\LocationService;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use App\Http\Services\UploaderService;

class LocationsController extends BaseController
{

    protected $locationService;
    private $locationRepository;
    protected $industryRepository;

    public function __construct(LocationService $LocationService, LocationRepository $locationRepository,  UploaderService $uploadService)
    {
        $this->authorizeResource(Location::class, "location");
        $this->locationService = $LocationService;
        $this->locationRepository = $locationRepository;
        $this->uploadService = $uploadService;

    }

    public function index(Request $request)
    {
        $this->authorize("index", Location::class);
        $list = $this->locationRepository->searchFromRequest($request)->paginate(10);
        if ($request->query->has('view') == 'tree') {
            return view('admin.locations.tree', [
                'all' => $list->get(),
                'list' => $list->where('parent_id', '=', null)->get(),
            ]);
        }
        $list->appends(request()->all());
        return view('admin.locations.index', ['list' => $list]);
    }

    public function create(Request $request)
    {
        return view('admin.locations.new');
    }

    public function store(LocationRequest $request)
    {     
        $this->locationService->fillFromRequest($request);
        return redirect(route('admin.locations.index'))->with('success', trans('item_added_successfully'));
    }
    
    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location)
    {
        $this->locationService->fillFromRequest($request, $location);
        event(new LocationEditedEvent($location));
//        return 'aaa';
        return redirect(route('admin.locations.index'))->with('success', trans('item_updated_successfully'));
    }

    public function destroy(Location $location)
    {
        $this->uploadService->deleteFile($location->image);
        $location->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }

    public function show(Location $location)
    {
        $this->authorize('view',$location);
        request()->query->set('parent', $location->id);
        $cities = $this->locationRepository->searchFromRequest(request())->paginate(10);
        $cities->appends(request()->all());
        return view('admin.locations.city.index',compact('cities')) ;
    }
}
