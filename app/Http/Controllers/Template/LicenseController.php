<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\LicenseRepository;
use App\Http\Resources\TemplateResource;
use App\Models\Template\License;
use App\Models\template\UserGuide;

class LicenseController extends Controller
{

    private $licenseRepository;

    public function __construct(LicenseRepository $licenseRepository)
    {
        $this->licenseRepository = $licenseRepository;

    }

    public function getUserGuide()
    {
        return new TemplateResource(UserGuide::first());
    } 
    
    public function updateUserGuide(Request $request,$id)
    {
        $data = UserGuide::findOrFail($id);
        $data->update([
            'content' => $request->content,
        ]);

        return $data ? response()->json(['data' => $data],200) : response()->json(['data' => 'error'],500);
    }

    public function show($id)
    {
        return $this->licenseRepository->getDataByContentId($id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = License::findOrFail($id);
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
