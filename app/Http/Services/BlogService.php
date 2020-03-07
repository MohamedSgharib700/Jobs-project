<?php

namespace App\Http\Services;

use App\Models\Blog;
use Symfony\Component\HttpFoundation\Request;


class BlogService
{
    protected $uploaderService;
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }
    public function fillFromRequest(Request $request, $blog = null)
    {
        if (!$blog) {
            $blog = new Blog();
        }
        if (!empty($request->file('image'))) {
            $blog->image = $this->uploaderService->upload($request->file('image'), 'blog');
        }

        $blog->fill($request->request->all());
        
        if ($request->method()=='post') {
            $blog->active = $request->request->get('active', 1);
        }
        
        $blog->save();

        return $blog;
    }
}
