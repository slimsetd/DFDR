<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Year;
use App\Models\UploadForm;
use Illuminate\Http\Request;

use App\Mail\VerifiedUserRegisteredMail;
use App\Mail\RejectedUserRegisteredMail;
use App\Mail\ResetPasswordToken;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

use App\Exports\TemplateExport;
use App\Exports\UsersExport;
use App\Exports\EditorExport;
use App\Imports\UsersImport;
use App\Imports\EditorImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class UserController extends Controller
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
      $user = User::orderBy('id', 'DESC')->get();
      return $this->success(['user' => $user]);
    }

    public function userEditor()
    {
      $user = User::orderBy('id', 'DESC')
              ->where('role', '=', 'Editor')
              ->get();
      return $this->success(['user' => $user]);
    }

    public function userDepositCont()
    {
      $user = User::orderBy('id', 'DESC')
              ->where('role', '=', 'User')
              ->where('approved', '=', '1')
              ->get();

      foreach ($user as $val) {
        $faculty = Faculty::find($val->faculty);
        $deposit = UploadForm::where('user_id', '=', $val->id)->count();

        $val->faculty_name = $faculty->faculty_name;
        $val->contribution = $deposit;
      }

      return $this->success(['user' => $user]);
    }

    public function userMain()
    {
      $user = User::orderBy('id', 'DESC')
              ->where('role', '=', 'User')
              ->get();
      return $this->success(['user' => $user]);
    }

    public function viewPDF()
    {
      $fileName = 'file.pdf';
      return $this->success(['name' => $fileName]);
    }
    
    public function checkName(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if( User::where('name', '=', $request->name)->exists())
          return $this->error("data exist");
        else  
          return $this->success(null,"data new");
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        if( User::where('email', '=', $request->email)->exists())
          return $this->error("data exist");
        else  
          return $this->success(null,"data new");
    }

    public function checkSpecific(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
        ]);
        
        $cName = User::where('name', '=', $request->name)->exists();
        $cPBirth = User::where('place_of_birth', '=', $request->place_of_birth)->exists();
        $cDBirth = User::where('date_of_birth', '=', $request->date_of_birth)->exists();
        $cGender = User::where('gender', '=', $request->gender)->exists();

        if($cName && $cPBirth && $cDBirth && $cGender)
          return $this->error("data exist");
        else  
          return $this->success(null,"data new");
    }

    public function checkPass(Request $request, $id)
    {
      $request->validate([
        'password' => 'required|string'
      ]);
      
      $user = User::find($id);
      
      if(Hash::check($request->password, $user->password))
        return $this->success(null,"data exist");
      else
        return $this->error("data unexist");
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'code' => 'required'
        ]);
        
        $getData = User::where('email', '=', $request->email)->get();

        if (Hash::check($request->code, $getData[0]->remember_token))
          return $this->success(null,"data exist");  
        else  
          return $this->error("data new");
          // return $this->success($getData[0]->remember_token);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'user' => 'required',
        // ]);
        $user = User::create($request->all());
        return $this->success(['user' => $user ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $this->success(['user' => $user]);
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
        $user = User::find($id);

        switch ($request->approved) {
          case 1:
            $randomString = Str::random(3);
            $newPass = uniqid("dGR").$randomString.date("yd");

            date_default_timezone_set('Asia/Jakarta');

            $user->approved = $request->approved;
            $user->email_verified_at = date("Y-m-d h:i:s");
            
            if ($request->password != '' || $request->passwordRe != '')  // true
            { $user->password = bcrypt($request->passwordRe);}
            else
            { $user->password = bcrypt($newPass);}

            $user->save();

            $details = [
              'title' => $user->name,
              'body' => "Password : ".$newPass,
              'link' => url("")
            ];

            // Send Mail
            if ($request->password == '' || $request->passwordRe == '')  // true
            { Mail::to($user->email)->send(new VerifiedUserRegisteredMail($details)); }
            break;

          case 2:
            $user->approved = $request->approved;
            $user->save();

            $details = [
              'title' => $user->name
            ];

            // Send Mail
            Mail::to($user->email)->send(new RejectedUserRegisteredMail($details));
            break;
        }

        return $this->success(null, "data success");
    }

    public function updateData(Request $request, $id)
    {
      $request->validate([
          'name' => 'required',
          'email' => 'required',
          'phone' => 'required',
          'address' => 'required',
      ]);

      $user = User::find($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->phone = $request->phone;
      $user->address = $request->address;
      $user->save();
      // $user->update($request->all());
      
      if ($request->file('upload_card') != "")
      {
        if ($upload_card = $request->file('upload_card')) {
          $path = public_path() . '/storage/uploads/upload_card';
          $upload_card->move($path, $upload_card->getClientOriginalName());
        }
  
        $user->upload_card = url('/').'/show-image/upload_card/'.$upload_card->getClientOriginalName();
        $user->upload_card_name = $upload_card->getClientOriginalName();
        $user->save();
      }

      return $this->success(['user' => $user]);
    }

    public function updateDataFull(Request $request, $id) 
    {
      $request->validate([
          "name" => 'required',
          "phone" => 'required',
          "email" => 'required',
          "date_of_birth" => 'required',
          "place_of_birth" => 'required',
          "department" => 'required',
          "faculty" => 'required',
          "gender" => 'required',
          "year" => 'required',
          "address" => 'required',
      ]);

      $user = User::find($id);
      $y = $user->password;
      $user->update($request->all());
      
      if ($request->file('upload_card') != "")
      {
        if ($upload_card = $request->file('upload_card')) {
          $path = public_path() . '/storage/uploads/upload_card';
          $upload_card->move($path, $upload_card->getClientOriginalName());
        }

        $user->upload_card = url('/').'/show-image/upload_card/'.$upload_card->getClientOriginalName();
        $user->upload_card_name = $upload_card->getClientOriginalName();
        $user->save();
      }

      if ($request->password != 'undefined' || $request->passwordRe != 'undefined')  // true
      {
        $user->password = bcrypt($request->passwordRe);
        $user->save();
      }
      else
      {
        $user->password = $y;
        $user->save();
      }
      
      return $this->success(['user' => $request->name]);
    }

    public function changePass(Request $request, $id)
    {
      $request->validate([
        'password' => 'required|string',
        'newPass' => 'required|string'
      ]);
      
      $user = User::find($id);
      
      if(Hash::check($request->password, $user->password))
      {
        $user->password = bcrypt($request->newPass);
        $user->save();

        return $this->success(null, "data exist");
      }
      else
        return $this->error("data unexist");
    }

    public function reqResetPass(Request $request)
    {
      $request->validate([
        'email' => 'required',
      ]);
        
      $getData = User::where('email', '=', $request->email)->get();
      
      $randomString = Str::random(5);
      $resToken = uniqid("dGRRP").$randomString;

      $user = User::find($getData[0]->id);
      $user->remember_token = bcrypt($resToken);
      $user->save();
      
      $details = [
        'title' => $user->name,
        'body' => "Reset Code : ".$resToken,
        'link' => url("")
      ];

      // Send Mail
      Mail::to($user->email)->send(new ResetPasswordToken($details)); 

      return $this->success($resToken);
    }

    public function resetPass(Request $request)
    {
      $request->validate([
        'email' => 'required',
        'code' => 'required',
        'password' => 'required|string',
        'newPass' => 'required|string',
      ]);

      $getData = User::where('email', '=', $request->email)->get();
      $user = User::find($getData[0]->id);
      
      if (Hash::check($request->code, $getData[0]->remember_token))
      {
        $user->password = bcrypt($request->newPass);
        $user->remember_token = null;
        $user->save();

        return $this->success(null, "data exist");
      }
      else
        return $this->error("data unexist");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::destroy($id);
      return $this->success(['user' => $user]);
    }

    public function export() 
    {
        // $now = date('Y-m-d');
        $fileName = 'User_Release.xlsx';
        File::delete('downloads/release/'.$fileName);

        $user = User::where('role', '=', 'User')->get();

        foreach ($user as $key) 
        {
          $faculty_name = Faculty::find($key->faculty);
          $key->faculty_name = $faculty_name->faculty_name;

          $department_name = Department::find($key->department);
          $key->department_name = $department_name->department_name;

          $year = Year::find($key->years);
          $key->years = $year->year;

          // $key->status = ucfirst($key->status);
          // $key->division_name = $key->uploadFormDivision[0]->division;
        }

        $data = ['user' => $user];

        $userexcel = Excel::store(new UsersExport($data), 'downloads/release/'.$fileName, 'real_public');
        return $this->success(['excel' => $fileName]);
    }

    public function exportEditor() 
    {
        $fileName = 'Editor_Release.xlsx';
        File::delete('downloads/release/'.$fileName);

        // get data..
        $user = User::where('role', '=', 'Editor')->get();
        $data = ['user' => $user];

        $userexcel = Excel::store(new EditorExport($data), 'downloads/release/'.$fileName, 'real_public');
        return $this->success(['excel' => $fileName]);
    }

    public function exportTemplate() 
    {
        $fileName = 'template_user.xlsx';
        return $this->success(['excel' => $fileName]);
    }

    public function exportExcel() 
    {
        dd("test");
    }

    public function import() 
    {
        $is_success = Excel::import(new UsersImport,request()->file('file'));
             
        return $is_success ? response()->json(['success' => true]) : response()->json(['success' => false]);
    }

    public function importEditor() 
    {
        Excel::import(new EditorImport,request()->file('file'));
             
        return back();
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
}
