<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\Category;
use Illuminate\Http\Request;

use Auth;

class CategoryController extends Controller
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
      $category = Category::orderBy('id', 'DESC')->get();
      return $this->success(['category' => $category]);
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
            'category_name' => 'required',
        ]);
        if( Category::where('category_name', '=', $request->category_name)->exists()){
          
          return $this->error("data ready exist");
        }else {
          $category = New Category;
          $category->category_name = $request->category_name;
          $category->created_by = Auth::User()->id;
          $category->save();
          
          return $this->success(['category' => $category ]);
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
        $category = Category::find($id);
        return $this->success(['category' => $category]);
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
        'category_name' => 'required',
      ]);

      if( Category::where('category_name', '=', $request->category_name)->exists())
      {   
        return $this->error("data ready exist");
      }
      else 
      {
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->updated_by = Auth::User()->id;
        $category->save();
        
        return $this->success(['category' => $category]);
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
      $category = Category::destroy($id);
      return $this->success(['category' => $category]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
      $category = Category::where('category_name', 'like', '%'.$name.'%')->get();
      return $this->success(['category' => $category]);
    }
}
