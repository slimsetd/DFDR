<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Subject;
use Illuminate\Http\Request;

use Auth;

class SubjectController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subject = Subject::orderBy('id', 'DESC')->get();
      return $this->success(['subject' => $subject]);
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
            'subject_name' => 'required',
        ]);
        if( Subject::where('subject_name', '=', $request->subject_name)->exists())
        {  
          return $this->error("data ready exist");
        }
        else 
        {
          $subject = New Subject;
          $subject->subject_name = $request->subject_name;
          $subject->created_by = Auth::User()->id;
          $subject->save();

          return $this->success(['subject' => $subject ]);
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
        $subject = Subject::find($id);
        return $this->success(['subject' => $subject]);
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
          'subject_name' => 'required',
      ]);

      if( Subject::where('subject_name', '=', $request->subject_name)->exists())
      {  
        return $this->error("data ready exist");
      }
      else 
      {
        $subject = Subject::find($id);
        $subject->subject_name = $request->subject_name;
        $subject->updated_by = Auth::User()->id;
        $subject->save();
          
        return $this->success(['subject' => $subject]);
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
      $subject = Subject::destroy($id);
      return $this->success(['subject' => $subject]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $subject = Subject::where('subject_name', 'like', '%'.$name.'%')->get();
      return $this->success(['subject' => $subject]);
    }
}
