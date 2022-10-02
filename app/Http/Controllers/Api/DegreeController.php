<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Degree;
use Illuminate\Http\Request;

use Auth;

class DegreeController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // dd("die");
      $degree = Degree::orderBy('id', 'DESC')->get();
      return $this->success(['degree' => $degree]);
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
            'degree_name' => 'required',
        ]);
        $degree = New Degree;
        $degree->degree_name = $request->degree_name;
        $degree->created_by = Auth::User()->id;
        $degree->save();
        
        return $this->success(['degree' => $degree ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $degree = Degree::find($id);
      return $this->success(['degree' => $degree]);
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
        'degree_name' => 'required',
      ]);
      $degree = Degree::find($id);
      $degree->degree_name = $request->degree_name;
      $degree->updated_by = Auth::User()->id;
      $degree->save();
      
      return $this->success(['degree' => $degree]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $degree = Degree::destroy($id);
      return $this->success(['degree' => $degree]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $degree = Degree::where('degree_name', 'like', '%'.$name.'%')->get();
      return $this->success(['degree' => $degree]);
    }
}
