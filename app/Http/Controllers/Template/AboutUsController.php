<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use App\Models\Template\AboutUs;
use App\Http\Controllers\Controller;
use App\Http\Resources\TemplateResource;
use App\Http\Controllers\Template\AboutUsRepository;

class AboutUsController extends Controller
{
    private $aboutRepository;

    public function __construct(AboutUsRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;

    }

    public function show($id)
    {
        return $this->aboutRepository->getDataByContentId($id);
    }

    public function index()
    {
       $data = TemplateResource::collection(AboutUs::get());
       return response()->json(['data' => $data],200);
    }

    public function update(Request $request, $id)
    {
        $data = AboutUs::findOrFail($id);
        $data->update([
            'content' => $request->content,
        ]);

        return $data ? response()->json(['data' => $data],200) : response()->json(['data' => 'error'],500);
    }
  
}
