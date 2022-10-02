<?php

namespace App\Http\Controllers\Template;

use App\Http\Resources\TemplateResource;
use App\Models\Template\HowSubmit;

class HowSubmitRepository {

    private $howSubmit;

    public function __construct(HowSubmit $howSubmit)
    {
       $this->howSubmit = $howSubmit;
    }
    
    public function getDataByContentId($id)
    {
        return new TemplateResource($this->howSubmit->where('content_type_id',$id)->first());
    }
}