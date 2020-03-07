<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserEditedEvent;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\SeekerExperience;
use App\Http\Services\SeekerService;
use App\Http\Requests\Admin\SeekerExperiencesRequest;
use App\Repositories\LocationRepository;
use App\Repositories\LanguageRepository;
use View;

class SeekerExperiencesController extends BaseController
{
    protected $seekerService;
    protected $locationRepository;
    protected $languageRepository;

    public function __construct(SeekerService $seekerService, LocationRepository $locationRepository, LanguageRepository $languageRepository)
    {
        $this->seekerService = $seekerService;
        $this->locationRepository = $locationRepository;
        $this->languageRepository = $languageRepository;
    }

    public function create(User $seeker)
    {
        request()->request->add(['active' => 1]);
        $languages = $this->languageRepository->search(request())->get();
        $countries = $this->locationRepository->searchFromRequest(request())->get();

        $seekerDetails = $seeker->details;

        return View::make('admin.seekers.experiences.new', ['seeker' => $seeker, 'languages' => $languages, 'seekerDetails' => $seekerDetails, 'countries' => $countries]);
    }

    public function store(SeekerExperiencesRequest $request, User $seeker)
    {
        $this->seekerService->fillSeekerExperiences($request,null, $seeker);

        return redirect(route('admin.seekers.index'))->with('success', trans('item_added_successfully'));
    }

    public function edit(User $seeker, SeekerExperience $seekerExperiences)
    {
        request()->request->add(['active' => 1]);
        $languages = $this->languageRepository->search(request())->get();
        $countries = $this->locationRepository->searchFromRequest(request())->get();
        $seekerDetails = $seeker->details;

        return View::make('admin.seekers.experiences.edit', ['seeker' => $seeker, 'seekerExperiences' => $seekerExperiences, 'languages' => $languages, 'seekerDetails' => $seekerDetails, 'countries' => $countries]);
    }

    public function update(SeekerExperiencesRequest $request, User $seeker, SeekerExperience $seekerExperiences)
    {
        $this->seekerService->fillSeekerExperiences($request, $seekerExperiences, $seeker);
        event(new UserEditedEvent($seeker));

        return redirect()->back()->with('success', trans('item_updated_successfully'));
    }
}
