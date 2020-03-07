<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Location ;
use App\Repositories\LocationRepository;
use App\Http\Services\LocationService;
use App\Http\Requests\Admin\LocationRequest;
use App\Http\Services\UploaderService;


class CitiesController extends BaseController
{
   
    protected $locationService;
    private $locationRepository;
    protected $industryRepository;

    public function __construct(LocationService $LocationService, LocationRepository $locationRepository, UploaderService $uploadService)
    {
        $this->locationService = $LocationService;
        $this->locationRepository = $locationRepository;
        $this->uploadService = $uploadService;

    }

    public function create()
    {
        return view('admin.locations.city.new') ;
    }
  
    public function store(LocationRequest $request )
    {
        $this->locationService->fillFromRequest($request);
        return redirect(route('admin.locations.show',['location'=>$request->parent_id]))->with('success', trans('item_added_successfully'));
    }
  
    public function edit(Location $city)
    {
        return view('admin.locations.city.edit',compact('city'));
    }

    public function update(LocationRequest $request,Location $city)
    {
        $this->locationService->fillFromRequest($request, $city);
        return redirect(route('admin.locations.show',['location'=>$request->parent_id]))->with('success', trans('item_updated_successfully'));
    }
  
    public function destroy(Location $city)
    {
        $this->uploadService->deleteFile($city->image);
        $city->delete();
        return redirect()->back()->with('success','item-deleted-successfully');
    }
}
