<?php

namespace App\Http\Controllers\Template;

use App\Http\Resources\TemplateResource;
use App\Models\Template\Home;

class HomeRepository {

    private $home;

    public function __construct(Home $home)
    {
       $this->home = $home;
    }
    
    public function getDataByContentId($id)
    {
        if ($id == 4) {
            return TemplateResource::collection($this->home->where('content_type_id',$id)->get());
        }
        return new TemplateResource($this->home->where('content_type_id',$id)->first());
    }
}