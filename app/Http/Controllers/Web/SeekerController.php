<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Web\PersonalDataRequest;
use App\Http\Requests\Web\JobDataRequest;
use App\Http\Requests\Web\SeekerRequest;
use App\Http\Services\SeekerService;
use App\Models\Location;
use App\Models\User;
use App\Repositories\IndustryRepository;
use App\Repositories\SeekerRepository;
use App\Repositories\SkillRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\SeekerExperience;
use App\Models\SeekerDetails;

use View;
use Auth;

class SeekerController extends BaseController
{
    protected $seekerService;
    protected $industryRepository;
    protected $skillRepository;

    protected $seekerRepository;
    protected $locationRepository;
    protected $uploadService;
    protected $languageRepository;

    public function __construct(SeekerService $seekerService, SeekerRepository $seekerRepository, LocationRepository $locationRepository,
                                IndustryRepository $industryRepository, LanguageRepository $languageRepository, SkillRepository $skillRepository)
    {
        $this->seekerService = $seekerService;
        $this->industryRepository = $industryRepository;
        $this->skillRepository = $skillRepository;
        $this->seekerRepository = $seekerRepository;
        $this->locationRepository = $locationRepository;
        $this->languageRepository = $languageRepository;
    }


    public function index(Request $request)
    {
        $list = $this->seekerRepository->search(request())->paginate(10);
        $list->appends(request()->all());

        $industries = $this->industryRepository->industriesHaveUsers(request());
        $roles      = $this->industryRepository->rolesHaveUsers(request());
        $languages  = $this->languageRepository->languagesHaveUsers(request());
        $countries = $this->locationRepository->workingCountriesHaveUsers(request());
        $residenceCountries = $this->locationRepository->residenceCountriesHaveUsers(request());

        $experience = collect(SeekerExperience::where('years_of_experience','!=',null)->get());
        $seekerExperience = $experience->unique('years_of_experience');
        $seekerExperience->values()->all();


        $experience = collect(SeekerExperience::where('career_level','!=',null)->get());
        $careerLevel = $experience->unique('career_level');
        $careerLevel->values()->all();

        $education = collect(SeekerExperience::where('education_level','!=',null)->get());
        $educationLevel = $education->unique('education_level');
        $educationLevel->values()->all();

        $age = collect(User::where('age','!=',null)->get());
        $age = $age->unique('age');
        $age->values()->all();

        $gender = collect(User::where('gender','!=',null)->get());
        $gender = $gender->unique('gender');
        $gender->values()->all();

        $maritalStatus = collect(SeekerDetails::where('marital_status','!=',null)->get());
        $maritalStatus = $maritalStatus->unique('marital_status');
        $maritalStatus->values()->all();

        $militaryStatus = collect(SeekerDetails::where('military_status','!=',null)->get());
        $militaryStatus = $militaryStatus->unique('military_status');
        $militaryStatus->values()->all();
        
        //      echo"<pre>";
        // print_r($SeekerExperience);
        // echo"</pre>"; return;
        // $countries = $this->locationRepository->searchFromRequest(request())->get();
        $cities = $this->locationRepository->searchCity(request())->get();

        return View::make('web.seekersFiltration', ['list' => $list, 'roles' => $roles, 'industries' => $industries, 'countries' => $countries, 'languages' => $languages, 'cities' => $cities,'residenceCountries' => $residenceCountries,'seekerExperience'=>$seekerExperience,'careerLevel' =>$careerLevel,'educationLevel' => $educationLevel, 'age' => $age,'gender'=>$gender,'maritalStatus' => $maritalStatus, 'militaryStatus' => $militaryStatus]);
    }

    public function personalInfo()
    {
        $user = User::find(42);
        Auth::login($user);

        $seeker = auth()->user();
        $countries = Location::where('active', 1)->where('parent_id', null)->get();
        $cities = [];
        if (old('country_key') || $seeker->country_key) {
            $country = old('country_key') ? old('country_key') : $seeker->country_key;
            $cities = Location::where('active', 1)->where('parent_id', $country)->get();
        }

        return View::make('web.users.personal-info', ['seeker' => $seeker, 'countries' => $countries, 'cities' => $cities]);
    }

    public function storePersonalData(PersonalDataRequest $request)
    {
        $seeker = $this->seekerService->fillPersonalData($request, auth()->user());

        $request->request->add(['user_id' => $seeker->id]);
        $this->seekerService->fillSeekerDetails($request, $seeker->details, $seeker);

        return redirect(route('web.users.register.job.info'))->with('success', trans('item_added_successfully'));
    }

    public function jobInfo()
    {
        $user = User::find(42);
        Auth::login($user);

        $seeker = auth()->user();

        request()->request->add(['active' => 1]);
        $industries = $this->industryRepository->search(request())->get();
        $skills = $this->skillRepository->search(request())->get();

        $seekerIndustriesArray = [];
        foreach ($seeker->industries as $industry) {
            $seekerIndustriesArray[] = $industry->id;
        }

        request()->request->add(['industries' => $seekerIndustriesArray]);
        $roles = $this->industryRepository->roles(request())->get();

        $details = $seeker->details;

        if ($details) {
            return View::make('web.users.job-info-update', ['industries' => $industries, 'roles' => $roles, 'skills' => $skills, 'seeker' => $seeker, 'details' => $details]);
        }

        return View::make('web.users.job-info', ['industries' => $industries, 'skills' => $skills, 'seeker' => $seeker, 'details' => $details]);
    }

    public function storeJobData(JobDataRequest $request)
    {
        $user = User::find(42);
        Auth::login($user);

        $seeker = auth()->user();
        $details = $seeker->details;
        $this->seekerService->fillPersonalData($request, $seeker); //to save job_title in users table
        $this->seekerService->fillSeekerDetails($request, $details, $seeker);

        return redirect(route('web.seeker.register.job.info'))->with('success', trans('item_added_successfully'));
    }

    public function experiencesInfo()
    {
        $countries = Location::where('active', 1)->where('parent_id', null)->get();

        $cities = [];
        if (old('country_key')) {
            $cities = Location::where('active', 1)->where('parent_id', old('country_key'))->get();
        }

        return View::make('web.users.experience-info', ['countries' => $countries, 'cities' => $cities]);
    }

    public function edit(User $seeker)
    {

        return View::make('web.seekerProfile', ['seeker' => $seeker]);

    }

    public function destroy(User $seeker)
    {
        $seeker->delete();
        return redirect('/');
    }

}
