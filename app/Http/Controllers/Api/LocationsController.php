<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Location ;
use App\Repositories\LocationRepository;


class LocationsController extends Controller
{
    public $locationRepository ;
    public function __construct(LocationRepository $locationRepository)
    {
          $this->locationRepository = $locationRepository;
    }

    public function index(Request $request )
    {
         request()->request->add(['active' => 1]);
        $locations = $this->locationRepository->searchFromRequest(request())->get();
        return response()->json($locations);
    }
}
