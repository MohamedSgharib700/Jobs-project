<?php

namespace App\Repositories;

use App\Models\Blog;
use Symfony\Component\HttpFoundation\Request;

class BlogRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $blog = Blog::query()->orderByDesc("id");

        if ($request->has('name') && !empty($request->get('name'))) {
            $blog->whereHas('translations', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
        }
        if ($request->has('active') && !empty($request->get('active'))) {
            $blog->where('active', $request->get('active')) ;
        }

        return $blog;
    }

    public function roles(Request $request)
    {
        $blog = Blog::query()->orderByDesc("id");

        if ($request->query->has('blog')) {
            $blog->whereIn('parent_id', $request->query->get('blog'));
        }
        return $blog;
    }

}
