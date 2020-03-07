<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Skill;
use App\Models\SeekerDetails;
use App\Models\SeekerExperience;
use App\Constants\UserTypes;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;
use File;

class SeekerService
{
    protected $uploaderService;
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function fillPersonalData(Request $request, $user = null)
    {
        if (!$user) {
            $user = new User();
        }

        $user->fill($request->all());

        if ($request->method()=='post') {
            $user->active = $request->request->get('active', 1);
        }

        if($request->filled('gender')) {
            $user->gender = $request->gender;
        }

        $user->type = UserTypes::SEEKER;
        $user->job_title = $request->get('job_title');

        $user->save();

        return $user;
    }

    public function fillSeekerDetails(Request $request, $seekerDetails = null, $seeker = null)
    {
        if (!$seekerDetails) {
            $seekerDetails = new SeekerDetails();
        }
        $seekerDetails->fill($request->all());

        if (!empty($request->has('industry_id'))) {
            $seeker->industries()->sync($request->input("industry_id"));
        }

        if (!empty($request->has('roles'))) {
            $seeker->roles()->sync($request->input("roles"));
        }

        if (!empty($request->has('skills'))) {
            $skills = [];
            foreach ($request->input("skills") as $value) {
                $skill = Skill::find($value);
                if (!$skill) {
                    $skill = new Skill();
                    $skill->title = $value;
                    $skill->save();
                }
                $skills[] = $skill->id;
            }
            $seeker->skills()->sync($skills);
        }

        if (!empty($request->file('cv'))) {
            $seekerDetails->cv = $this->uploaderService->upload($request->file('cv'), 'CVs');
        }

        if ($seeker) {
            $seekerDetails->user_id = $seeker->id;
        }

        $seekerDetails->save();

        return $seekerDetails;
    }

    public function fillSeekerExperiences(Request $request, $seekerExperience = null, $seeker = null)
    {
        if (!$seekerExperience) {
            $seekerExperience = new SeekerExperience();
        }
        $seekerExperience->fill($request->all());

        $seekerExperience->user_id = $seeker->id;

        if (!empty($request->has('languages'))) {
            $seeker->languages()->sync($request->input("languages"));
        }
        if (!empty($request->has('working_countries'))) {
            $seeker->workingCountries()->sync($request->input("working_countries"));
        }

        $seekerExperience->save();

        return $seekerExperience;
    }

    public function import()
    {
        $table = 'App\Models\User';
        $columns = [
            'first_name',
            'last_name',
            'email',
            'phone',
            'password',
            'job_title'
        ];

        try {
            Excel::import(new ImportService($table, $columns), request()->file('select_file'));
        } catch (\Exception $e) {
            return back()->with('danger', trans('something_went_wrong_check_file'));
        }

        return back()->with('success', trans('item_imported_successfully'));
    }


}
