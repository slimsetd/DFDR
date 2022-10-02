<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\HowSubmitRepository;
use App\Http\Resources\TemplateResource;
use App\Models\Template\HowSubmit;

class HowSubmitController extends Controller
{

    private $howSubmitRepository;

    public function __construct(HowSubmitRepository $howSubmitRepository)
    {
        $this->howSubmitRepository = $howSubmitRepository;

    }

    public function show($id)
    {
        return $this->howSubmitRepository->getDataByContentId($id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TemplateResource::collection(HowSubmit::get());
        return response()->json(['data' => $data],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = HowSubmit::findOrFail($id);
        $data->update([
            'content' => $request->content,
        ]);

        return $data ? response()->json(['data' => $data],200) : response()->json(['data' => 'error'],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
