<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Division;
use Illuminate\Http\Request;

use Auth;

class DivisionController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $division = Division::orderBy('id', 'DESC')->get();
      return $this->success(['division' => $division]);
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
            'division_name' => 'required',
        ]);

        if( Division::where('division_name', '=', $request->division_name)->exists())
        {  
          return $this->error("data already exist");
        }
        else 
        {
          $division = New Division;
          $division->division_name = $request->division_name;
          $division->created_by = Auth::User()->id;
          $division->save();
          
          return $this->success(['division' => $division ]);
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
        $division = Division::find($id);
        
        return $this->success(['division' => $division]);
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
          'division_name' => 'required',
        ]);

        if( Division::where('division_name', '=', $request->division_name)->exists())
        {  
          return $this->error("data already exist");
        }
        else 
        {
          $division = Division::find($id);
          $division->division_name = $request->division_name;
          $division->updated_by = Auth::User()->id;
          $division->save();
          
          return $this->success(['division' => $division]);
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
      $division = Division::destroy($id);
      return $this->success(['division' => $division]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $division = Division::where('division_name', 'like', '%'.$name.'%')->get();
      return $this->success(['division' => $division]);
    }
}
