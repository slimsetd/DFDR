<?php

namespace App\Http\Controllers\Template;

use App\Http\Resources\TemplateResource;
use App\Models\Template\License;

class LicenseRepository {

    private $license;

    public function __construct(License $license)
    {
       $this->license = $license;
    }
    
    public function getDataByContentId($id)
    {
        return new TemplateResource($this->license->findOrFail($id));
    }
}