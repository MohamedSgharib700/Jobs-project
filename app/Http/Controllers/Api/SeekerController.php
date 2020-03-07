<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\SeekerService;
use App\Http\Requests\Web\SeekerRequest ;
use App\Models\User;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Hash;

class SeekerController extends Controller
{

    protected $seekerService;

    public function __construct(SeekerService $seekerService)
    {
        $this->seekerService = $seekerService;
    }

    public function changeEmail (SeekerRequest $request, User $seeker)
    {
        $result = $this->seekerService->fillPersonalData($request, $seeker);

        return response()->json($result);
    }

    public function changePassword (SeekerRequest $request, User $seeker)
    {
       if(Hash::check($request['old_password'] ,$seeker->password)  ) {
           $result = $this->seekerService->fillPersonalData($request, $seeker);
           return response()->json($result);
       }else{

           return back()->with('error',trans('password_incorrect')) ;
       }


    }
}
