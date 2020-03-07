<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRepository;
use App\Repositories\LocationRepository;
use App\Repositories\IndustryRepository;
use App\Repositories\AgencyRepository;
use App\Constants\UserTypes;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use View;
use App\Models\Industry ;
class HomeController extends BaseController
{

    protected $userRepository;
    protected $locationRepository;
    protected $industryRepository;
    protected $agencyRepository;


    public function __construct(UserRepository $userRepository, LocationRepository $locationRepository, IndustryRepository $industryRepository, AgencyRepository $agencyRepository)
    {
        $this->userRepository = $userRepository;
        $this->locationRepository = $locationRepository;
        $this->industryRepository = $industryRepository;
        $this->agencyRepository = $agencyRepository;
    }

    public function index()
    {
        request()->query->set('type', UserTypes::OWNER);
        $employersList = $this->userRepository->search(request())->limit(3)->get();

        request()->query->set('type', UserTypes::SEEKER);
        $seekersList = $this->userRepository->search(request())->limit(3)->get();
   

        $agenciesList = $this->agencyRepository->searchFromRequest(request())->limit(3)->get();

        request()->query->set('active', 1);



        $employersCount = $this->userRepository->search(request())->count();
        $seekersCount = $this->userRepository->search(request())->count();
        $agenciesCount = $this->agencyRepository->searchFromRequest(request())->count();
        $locationsCount = $this->locationRepository->searchFromRequest(request())->count();
        $industriesCount = $this->industryRepository->search(request())->count();

        request()->query->set('from_date', Carbon::now()->subDays(30)->format('Y-m-d'));

        request()->query->set('type', UserTypes::OWNER);
        $ownerDataChartQuery = $this->userRepository->Charts(request())->get();
        $userChartsData = [];
        foreach ($ownerDataChartQuery as $row_owner) {
            $userChartsData[$row_owner->day]['days'] = $row_owner->day;
            $userChartsData[$row_owner->day]['owner'] = $row_owner->number;
            $userChartsData[$row_owner->day]['seeker'] = 0;
        }

        request()->query->set('type', UserTypes::SEEKER);
        $seekersDataChartQuery = $this->userRepository->Charts(request())->get();
        foreach ($seekersDataChartQuery as $row_seeker) {
            if (!isset($userChartsData[$row_seeker->day]['owner'])) {
                $userChartsData[$row_seeker->day]['owner'] = '0';
            }
            $userChartsData[$row_seeker->day]['days'] = $row_seeker->day;
            $userChartsData[$row_seeker->day]['seeker'] = $row_seeker->number;
        }

        $userChartsDataArray = array_sort($userChartsData);
        $userChartsAllData = array();
        foreach ($userChartsDataArray as $rowData) {
            $userChartsAllData['days'][] = $rowData['days'];
            $userChartsAllData['owner'][] = $rowData['owner'];
            $userChartsAllData['seeker'][] = $rowData['seeker'];
        }

        $industries = Industry::whereHas('users')->pluck('id');         
        $seekerCounts = [];
        foreach($industries as  $industry)
        {
            array_push($seekerCounts, Industry::find($industry)->users->count() )   ;
        }
        $industriesNames= [] ;
        $industriess = Industry::whereHas('users')->get();
        foreach($industriess as $industry)
        {
            array_push($industriesNames, $industry->name ) ;
        }
        
        return View::make('admin.home.index', [
            'employersList' => $employersList,
            'employersCount' => $employersCount,
            'seekersList' => $seekersList,
            'seekersCount' => $seekersCount,
            'locationsCount' => $locationsCount,
            'industriesCount' => $industriesCount,
            'agenciesCount' => $agenciesCount,
            'agenciesList' => $agenciesList,
            'userChartsAllData' => $userChartsAllData,
            'industriesNames'=>$industriesNames,
            'seekerCounts'=>$seekerCounts,
        ]);
    }
}
