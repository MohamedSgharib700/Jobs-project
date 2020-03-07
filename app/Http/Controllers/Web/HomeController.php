<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Repositories\BlogRepository;
use App\Repositories\JobRepository;
use App\Repositories\IndustryRepository;
use View;
use App\Models\Job;
use App\Models\Industry;
class HomeController extends BaseController
{

    protected $blogRepository;
    protected $jobRepository;
    protected  $industryRepository;

    public function __construct(BlogRepository $blogRepository, JobRepository $jobRepository, IndustryRepository $industryRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->jobRepository = $jobRepository;
        $this->industryRepository = $industryRepository;
  
    }
    public function index()
    {

        request()->query->set('active', 1);
        $industries = $this->industryRepository->jobCount(request());
        $list = $this->blogRepository->search(request())->limit(3)->get();
        $jobs = $this->jobRepository->search(request())->get();

        return View::make('web.home.index', ['list' => $list, 'jobs' => $jobs, 'industries' =>$industries]);
    }
}
