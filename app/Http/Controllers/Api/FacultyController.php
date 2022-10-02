<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Faculty;
use Illuminate\Http\Request;

use Auth;

class FacultyController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $faculty = Faculty::orderBy('id', 'DESC')->get();
      return $this->success(['Faculty' => $faculty]);
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
            'faculty_name' => 'required',
        ]);

        if( Faculty::where('faculty_name', '=', $request->faculty_name)->exists())
        {  
          return $this->error("data ready exist");
        }
        else 
        {
          $faculty = New Faculty;
          $faculty->faculty_name = $request->faculty_name;
          $faculty->created_by = Auth::User()->id;
          $faculty->save();

          return $this->success(['Faculty' => $faculty ]);
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
        $faculty = Faculty::find($id);
        return $this->success(['Faculty' => $faculty]);
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
            'faculty_name' => 'required',
        ]);

        if( Faculty::where('faculty_name', '=', $request->faculty_name)->exists())
        {  
          return $this->error("data ready exist");
        }
        else 
        {
          $faculty = Faculty::find($id);
          $faculty->faculty_name = $request->faculty_name;
          $faculty->updated_by = Auth::User()->id;
          $faculty->save();
          
          return $this->success(['Faculty' => $faculty]);
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
      $faculty = Faculty::destroy($id);
      return $this->success(['Faculty' => $faculty]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $faculty = Faculty::where('faculty_name', 'like', '%'.$name.'%')->get();
      return $this->success(['Faculty' => $faculty]);
    }
}
