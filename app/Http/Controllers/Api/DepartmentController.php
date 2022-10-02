<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Department;
use Illuminate\Http\Request;

use Auth;

class DepartmentController extends Controller
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
      $department = Department::orderBy('id', 'DESC')->get();
      return $this->success(['department' => $department]);
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
            'department_name' => 'required',
        ]);

        if( Department::where('department_name', '=', $request->department_name)->exists())
        {  
          return $this->error("data already exist");
        }
        else 
        {
          $department = New Department;
          $department->department_name = $request->department_name;
          $department->created_by = Auth::User()->id;
          $department->save();

          return $this->success(['department' => $department ]);
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
      $department = Department::find($id);
      return $this->success(['department' => $department]);
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
        'department_name' => 'required',
      ]);

      if( Department::where('department_name', '=', $request->department_name)->exists())
        {  
          return $this->error("data ready exist");
        }
        else 
        {
          $department = Department::find($id);
          $department->department_name = $request->department_name;
          $department->updated_by = Auth::User()->id;
          $department->save();

          return $this->success(['department' => $department]);
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
      $department = Department::destroy($id);
      return $this->success(['department' => $department]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $department = Department::where('department_name', 'like', '%'.$name.'%')->get();
      return $this->success(['department' => $department]);
    }
}
