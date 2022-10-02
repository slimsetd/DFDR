<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Language;
use Illuminate\Http\Request;

use Auth;

class LanguageController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $language = Language::orderBy('id', 'DESC')->get();
      return $this->success(['language' => $language]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'language_name' => 'required',
        ]);

        if( Language::where('language_name', '=', $request->language_name)->exists())
        {  
          return $this->error("data ready exist");
        }
        else 
        {
          $language = New Language;
          $language->language_name = $request->language_name;
          $language->created_by = Auth::User()->id;
          $language->save();

          return $this->success(['language' => $language ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::find($id);
        return $this->success(['language' => $language]);
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
        $request->validate([
          'language_name' => 'required',
        ]);

        if( Language::where('language_name', '=', $request->language_name)->exists())
        {  
          return $this->error("data ready exist");
        }
        else 
        {
          $language = Language::find($id);
          $language->language_name = $request->language_name;
          $language->updated_by = Auth::User()->id;
          $language->save();
          
          return $this->success(['language' => $language]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $language = Language::destroy($id);
      return $this->success(['language' => $language]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $language = Language::where('language_name', 'like', '%'.$name.'%')->get();
      return $this->success(['language' => $language]);
    }
}
