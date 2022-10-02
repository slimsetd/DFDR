<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
  use ApiResponser;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $instruction = Instruction::orderBy('id', 'DESC')->get();
    return $this->success(['instruction' => $instruction]);
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
        'instruction_name' => 'required',
        'instruction_desc' => 'required',
      ]);
      $instruction = New Instruction;
      $instruction->faculty_name = $request->faculty_name;
      $instruction->faculty_desc = $request->faculty_desc;
      $instruction->created_by = Auth::User()->id;
      $instruction->save();
      return $this->success(['instruction' => $instruction ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $instruction = Instruction::find($id);
      return $this->success(['instruction' => $instruction]);
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
        'instruction_name' => 'required',
        'instruction_desc' => 'required',
      ]);
      $instruction = Instruction::find($id);
      $instruction->faculty_name = $request->faculty_name;
      $instruction->faculty_desc = $request->faculty_desc;
      $instruction->updated_by = Auth::User()->id;
      $instruction->save();
      
      return $this->success(['instruction' => $instruction]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $instruction = Instruction::destroy($id);
    return $this->success(['instruction' => $instruction]);
  }

   /**
   * Search for a name
   *
   * @param  str  $name
   * @return \Illuminate\Http\Response
   */
  public function search($name)
  {
    $instruction = Instruction::where('instruction_name', 'like', '%'.$name.'%')->get();
    return $this->success(['instruction' => $instruction]);
  }
}
