<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\ContactRepository;
use App\Models\Template\Contact;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;

    }

    public function show($id)
    {
        return $this->contactRepository->getDataByContentId($id);
    }

    public function update(Request $request, $id)
    {
        $data = Contact::findOrFail($id);
        $data->update([
            'content' => $request->content,
        ]);

        return $data ? response()->json(['data' => $data],200) : response()->json(['data' => 'error'],500);
    }
}
