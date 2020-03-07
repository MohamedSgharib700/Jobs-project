<?php

namespace App\Http\Services;

use App\Models\Location;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Services\UploaderService ;
use input ;
class LocationService
{
    
    public $uploaderService ;

    public function __construct(UploaderService $uploaderService) {
    
        $this->uploaderService =$uploaderService ;
    
    }


    public function fillFromRequest(Request $request, $location = null )
    {
      
        if (!$location ){
            $location = new Location();
        }

        $location->fill($request->request->all());
        if ($request->method()=='post') {
         $location->active = $request->request->get('active', 1);
         }

        if($request->has('parent_id')) {
            $location->parent_id=$request->parent_id;
        }

        if($request->file('image')) {
            $location->image = $this->uploaderService->upload($request->file('image'), 'locations_image');
        }

        $location->save();

        return $location;

    }
}
