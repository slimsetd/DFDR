<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Year;
use Illuminate\Http\Request;

use Auth;

class YearController extends Controller
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
      $year = Year::orderBy('id', 'DESC')->get();
      return $this->success(['year' => $year]);
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
            'year' => 'required',
        ]);

        if( Year::where('year', '=', $request->year)->exists())
        {  
          return $this->error("data already exist");
        }
        else 
        {
          $year = New Year;
          $year->year = $request->year;
          $year->created_by = Auth::User()->id;
          $year->save();

          return $this->success(['year' => $year ]);
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
        $year = Year::find($id);
        return $this->success(['year' => $year]);
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
            'year' => 'required',
        ]);
        if( Year::where('year', '=', $request->year)->exists())
        {  
          return $this->error("data already exist");
        }
        else 
        {
          $year = Year::find($id);
          $year->year = $request->year;
          $year->created_by = Auth::User()->id;
          $year->save();
          
          return $this->success(['year' => $year]);
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
      $year = Year::destroy($id);
      return $this->success(['year' => $year]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $year = Year::where('year', 'like', '%'.$name.'%')->get();
      return $this->success(['year' => $year]);
    }
}
