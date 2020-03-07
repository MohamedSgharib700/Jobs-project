<?php

namespace App\Http\Services;

use App\Models\Industry;
use Symfony\Component\HttpFoundation\Request;
use File;

class IndustryService
{
    protected $uploaderService;
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }
    public function fillFromRequest(Request $request, $industry = null)
    {
        if (!$industry) {
            $industry = new Industry();
        }
        if (!empty($request->file('image'))) {
            $industry->image = $this->uploaderService->upload($request->file('image'), 'industries');
        }

        $industry->fill($request->request->all());
        
        if ($request->method()=='post') {
            $industry->active = $request->request->get('active', 1);
        }
        
        $industry->save();

        return $industry;
    }
}
