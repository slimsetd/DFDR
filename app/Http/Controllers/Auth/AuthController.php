<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ApiCode;
use App\Models\User;
use App\Models\NotifyUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;

use App\Traits\ApiResponser;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

use App\Mail\VerifiedUserRegisteredMail;
use App\Mail\RegisteredUserMail;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;

class AuthController extends Controller
{
  use ApiResponser;

    public function register(Request $request) {
        // dd($request->all());
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            // 'password' => 'required|string|confirmed',
            'phone' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'department' => 'required',
            'faculty' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'years' => 'required',
            'role' => 'required',
            'upload_card' => 'required|mimes:png,jpg|max:2048',
            'created_from' => 'required',
        ]);

        
        if ($upload_card = $request->file('upload_card')) {

          $path = public_path() . '/storage/uploads/upload_card';
          $upload_card->move($path, $upload_card->getClientOriginalName());
        }

        $randomString = Str::random(3);
        $newPass = uniqid("dGR").$randomString.date("yd");

        $user = new User();
          $user->name = $fields['name'];
          $user->email = $fields['email'];
          $user->phone = $fields['phone'];
          $user->place_of_birth = $fields['place_of_birth'];
          $user->date_of_birth = $fields['date_of_birth'];
          $user->department = $fields['department'];
          $user->faculty = $fields['faculty'];
          $user->gender = $fields['gender'];
          $user->address = $fields['address'];
          $user->years = $fields['years'];

          if($fields['created_from'] == 'Dashboard')
          { $user->approved = 1; }

          $user->upload_card = url('/').'/show-image/upload_card/'.$upload_card->getClientOriginalName();
          $user->upload_card_name = $upload_card->getClientOriginalName();
          $user->photo = "-";
          $user->role = $fields['role'];
          $user->password = bcrypt($newPass);

          if ($request->password != 'undefined' || 
              $request->passwordRe != 'undefined' ||
              $request->password != '' || 
              $request->passwordRe != '')  // true
            $user->password = bcrypt($request->passwordRe);

          $user->save();

          $token = $user->createToken('myapptoken')->plainTextToken;

          $notif_user = new NotifyUser;
          $notif_user->message = 'new user with email ' . $user->email;
          $notif_user->user_id = $user->id;
          $notif_user->save();
          
          if($fields['created_from'] == 'Dashboard')
          {
            // approved
            $details = [
              'title' => $user->name,
              'body' => "Password : ".$newPass,
              'link' => url("")
            ];

            if ($request->password == 'undefined' || 
                $request->passwordRe == 'undefined' ||
                $request->password == '' || 
                $request->passwordRe == '')  // true
              Mail::to($user->email)->send(new VerifiedUserRegisteredMail($details));
          }
          else
          {
            // pending
            $details = [
              'title' => $user->name
            ];

            Mail::to($user->email)->send(new RegisteredUserMail($details));
          }

          return $this->success(['user' => $user , 'token' => $token]);
    }

    public function registerAdmin(Request $request) {
        
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'role' => 'required',
            'upload_card' => 'required|mimes:png,jpg|max:2048',
        ]);
        
        if ($upload_card = $request->file('upload_card')) {
          $path = public_path() . '/storage/uploads/upload_card';
          $upload_card->move($path, $upload_card->getClientOriginalName());
        }

        $user = new User();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->phone = $fields['phone'];
        $user->place_of_birth = $fields['place_of_birth'];
        $user->date_of_birth = $fields['date_of_birth'];
        $user->department = '1';
        $user->faculty = '0';
        $user->gender = $fields['gender'];
        $user->address = $fields['address'];
        $user->years = '0';
        $user->approved = 1;
        $user->upload_card = url('/').'/show-image/upload_card/'.$upload_card->getClientOriginalName();
        $user->upload_card_name = $upload_card->getClientOriginalName();
        $user->photo = "-";
        $user->role = "Admin";
        $user->password = bcrypt($fields['password']);
        $user->save();

          /*
          $token = $user->createToken('myapptoken')->plainTextToken;

          $notif_user = new NotifyUser;
          $notif_user->message = 'new user with email ' . $user->email;
          $notif_user->user_id = $user->id;
          $notif_user->save();
          
          if($fields['created_from'] == 'Dashboard')
          {
            // approved
            $details = [
              'title' => $user->name,
              'body' => "Password : ".$newPass,
              'link' => url("")
            ];

            Mail::to($user->email)->send(new VerifiedUserRegisteredMail($details));
          }
          else
          {
            // pending
            $details = [
              'title' => $user->name
            ];

            Mail::to($user->email)->send(new RegisteredUserMail($details));
          }*/

        return $this->success(['user' => $fields]);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        
        // Check email
        $user = User::where('email', $fields['email'])->first();
        if($user->approved == 0){
          return response([
            'status' => 'false',
            'message' => 'Your account need confirmation from admin'
          ], 200);
        }
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
              'status' => 'false',
                'message' => 'Login Fail, please check email or password must valid'
            ], 200);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return $this->success(['user' => $user , 'token' => $token]);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function preAdmin() {
      
      $user = User::get()->count();
      return $this->success(['data' => $user]);
    }

  //   public function forgotPassword(Request $request)
  //   {
  //     // dd(env('MAIL_HOST'));
  //     // $fields = $request->validate([
  //     //   'email' => 'required|string',
  //     // ]);
      
  //     $credentials = request()->validate(['email' => 'required|email']);
  //     $test = Password::sendResetLink($credentials);
      
  //     dd($test);

  //     return response()->json(["msg" => 'Reset password link sent on your email id.']);

  //   }

  //   public function reset(ResetPasswordRequest $request) {
  //     $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
  //         $user->password = $password;
  //         $user->save();
  //     });

  //     if ($reset_password_status == Password::INVALID_TOKEN) {
  //         return $this->success(ApiCode::INVALID_RESET_PASSWORD_TOKEN);
  //     }

  //     return $this->success("Password has been successfully changed");
  // }
}
