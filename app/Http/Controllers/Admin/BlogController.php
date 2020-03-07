<?php

namespace App\Http\Controllers\Admin;
use App\Events\BlogEditedEvent;
use App\Http\Controllers\BaseController;
use App\Models\Blog;
use App\Http\Services\BlogService;
use App\Http\Services\UploaderService;
use App\Repositories\BlogRepository;
use App\Http\Requests\Admin\BlogRequest;
use Illuminate\Http\Request;
use View;


class BlogController extends BaseController
{
    protected $blogService;
    protected $uploadService;
    protected $blogRepository;

    public function __construct(BlogService $blogService, BlogRepository $blogRepository, UploaderService $uploadService)
    {
        $this->blogService = $blogService;
        $this->blogRepository = $blogRepository;
        $this->uploadService = $uploadService;
       $this->authorizeResource(Blog::class, "blog");

    }

    public function index()
    {
       $this->authorize("index", Blog::class);
        $list = $this->blogRepository->search(request())->paginate(10);
        $list->appends(request()->all());

        return View::make('admin.blog.index', ['list' => $list]);
    }

    public function create()
    {
        return View::make('admin.blog.new');
    }

    public function store(BlogRequest $request)
    {
        $this->blogService->fillFromRequest($request);
        return redirect(route('admin.blog.index'))->with('success', trans('item_added_successfully'));
    }

    public function edit(Blog $blog)
    {
        return View::make('admin.blog.edit', ['blog' => $blog]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $this->blogService->fillFromRequest($request, $blog);
        event(new BlogEditedEvent($blog));
        return redirect(route('admin.blog.index'))->with('success', trans('item_updated_successfully'));
    }

    public function destroy(Blog $blog)
    {
        $this->uploadService->deleteFile($blog->image);
        $blog->delete();

        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
}
