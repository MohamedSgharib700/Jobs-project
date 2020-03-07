<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserEditedEvent;
use App\Http\Controllers\BaseController;
use App\Models\Industry;
use App\Models\SeekerDetails;
use App\Models\Skill;
use App\Models\User;
use App\Http\Services\SeekerService;
use App\Repositories\IndustryRepository;
use App\Repositories\SkillRepository;
use App\Http\Requests\Admin\SeekerDetailsRequest;
use View;

class SeekerDetailsController extends BaseController
{
    protected $seekerService;
    protected $industryRepository;
    protected $skillRepository;

    public function __construct(SeekerService $seekerService, IndustryRepository $industryRepository, SkillRepository $skillRepository)
    {
        $this->seekerService = $seekerService;
        $this->industryRepository = $industryRepository;
        $this->skillRepository = $skillRepository;
    }

    public function create(User $seeker)
    {
        request()->request->add(['active' => 1]);
        $industries = $this->industryRepository->search(request())->get();
        $skills = $this->skillRepository->search(request())->get();
        return View::make('admin.seekers.details.new', ['seeker' => $seeker, 'industries' => $industries, 'skills' => $skills]);
    }

    public function store(SeekerDetailsRequest $request, User $seeker)
    {
        $seekerDetails = $seeker->details;
        $this->seekerService->fillPersonalData($request, $seeker);
        $this->seekerService->fillSeekerDetails($request, $seekerDetails, $seeker);

        return redirect(route('admin.seeker.experiences.create' , ['seeker' => $seeker->id]))->with('success', trans('item_added_successfully'));
    }

    public function edit(User $seeker, SeekerDetails $seekerDetails)
    {
        request()->request->add(['active' => 1]);
        $industries = $this->industryRepository->search(request())->get();

        $seekerIndustriesArray = [];
        foreach ($seeker->industries as $industry) {
            $seekerIndustriesArray[] = $industry->id;
        }

        request()->request->add(['industries' => $seekerIndustriesArray]);
        $roles = $this->industryRepository->roles(request())->get();

        $skills = $this->skillRepository->search(request())->get();
        $seekerExperiences = $seeker->experiences;

        $selectedRoles = $seeker->roles;
        $selectedRolesIds = [];

        foreach ($selectedRoles as $role) {
            $selectedRolesIds [$role->id] =  $role->id;
        }

        return View::make('admin.seekers.details.edit', ['seeker' => $seeker, 'seekerDetails' => $seekerDetails, 'industries' => $industries, 'roles' => $roles, 'skills' => $skills, 'seekerExperiences' => $seekerExperiences, 'selectedRolesIds' => $selectedRolesIds, 'seekerIndustriesArray'=>$seekerIndustriesArray]);
    }

    public function update(SeekerDetailsRequest $request, User $seeker, SeekerDetails $seekerDetails)
    {
        $this->seekerService->fillPersonalData($request, $seeker);
        $this->seekerService->fillSeekerDetails($request, $seekerDetails, $seeker);
        event(new UserEditedEvent($seeker));

        return redirect()->back()->with('success', trans('item_updated_successfully'));
    }
}
