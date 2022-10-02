<?php

namespace App\Http\Controllers\Template;

use App\Http\Resources\TemplateResource;
use App\Models\Template\ContentGuidelane;

class ContentGuideLaneRepository {

    private $contentGuideLane;

    public function __construct(ContentGuidelane $contentGuideLane)
    {
       $this->contentGuideLane = $contentGuideLane;
    }
    
    public function getDataByContentId($id)
    {
        return new TemplateResource($this->contentGuideLane->where('content_type_id',$id)->first());
    }
}