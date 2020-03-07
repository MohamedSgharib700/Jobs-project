<?php

namespace App\Http\Controllers\Api;

use App\Repositories\IndustryRepository;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Request;

class RoleController extends Controller
{
    protected $industryRepository;

    public function __construct(IndustryRepository $industryRepository)
    {
        $this->industryRepository = $industryRepository;
    }

    public function index(Request $request)
    {
        $list = $this->industryRepository->roles($request)->get();

        return response()->json($list);
    }
}
