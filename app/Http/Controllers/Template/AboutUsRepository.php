<?php

namespace App\Http\Controllers\Template;

use App\Http\Resources\TemplateResource;
use App\Models\Template\AboutUs;

class AboutUsRepository {

    private $aboutUS;

    public function __construct(AboutUs $aboutUS)
    {
       $this->aboutUS = $aboutUS;
    }
    
    public function getDataByContentId($id)
    {
        return new TemplateResource($this->aboutUS->where('content_type_id',$id)->first());
    }
}