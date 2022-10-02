<?php

namespace App\Http\Controllers\Template;

use App\Http\Resources\TemplateResource;
use App\Models\Template\Contact;

class ContactRepository {

    private $contact;

    public function __construct(Contact $contact)
    {
       $this->contact = $contact;
    }
    
    public function getDataByContentId($id)
    {
        return new TemplateResource($this->contact->where('content_type_id',$id)->first());
    }
}