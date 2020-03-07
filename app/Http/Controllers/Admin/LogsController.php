<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Repositories\LogRepository ;

class LogsController extends BaseController
{

    private $logRepository;

    public function __construct( LogRepository $logRepository )
    {
        $this->logRepository = $logRepository;
    }


    public function index()
    {
        $this->authorize("index", Log::class);
        $list = $this->logRepository->search(request())->paginate(10);
        return view('admin.logs.index', ['list' => $list]);
    }



}
