<?php

namespace App\Http\Controllers\Admin;
use App\Events\IndustryEditedEvent;
use App\Http\Controllers\BaseController;
use App\Models\Industry;
use App\Http\Services\IndustryService;
use App\Http\Services\UploaderService;
use App\Repositories\IndustryRepository;
use App\Http\Requests\Admin\IndustryRequest;
use Illuminate\Http\Request;
use View;
use File;

class IndustryController extends BaseController
{
    protected $industryService;
    protected $uploadService;
    protected $industryRepository;

    public function __construct(IndustryService $industryService, IndustryRepository $industryRepository, UploaderService $uploadService)
    {
        $this->industryService = $industryService;
        $this->industryRepository = $industryRepository;
        $this->uploadService = $uploadService;
        $this->authorizeResource(Industry::class, "industry");

    }

    public function index()
    {
        $this->authorize("index", Industry::class);
        $list = $this->industryRepository->search(request())->paginate(10);
        $list->appends(request()->all());

        return View::make('admin.industries.index', ['list' => $list]);
    }

    public function create()
    {
        return View::make('admin.industries.new');
    }

    public function store(IndustryRequest $request)
    {
        $this->industryService->fillFromRequest($request);
        return redirect(route('admin.industries.index'))->with('success', trans('item_added_successfully'));
    }

    public function edit(Industry $industry)
    {
        return View::make('admin.industries.edit', ['industry' => $industry]);
    }

    public function update(IndustryRequest $request, Industry $industry)
    {
        $this->industryService->fillFromRequest($request, $industry);
        event(new IndustryEditedEvent($industry));
        return redirect(route('admin.industries.index'))->with('success', trans('item_updated_successfully'));
    }

    public function destroy(Industry $industry)
    {
        $this->uploadService->deleteFile($industry->image);
        $industry->delete();

        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
