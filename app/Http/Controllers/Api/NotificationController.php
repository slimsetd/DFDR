<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\ApiResponser;
use App\Models\User;
use App\Models\NotifyUser;
use App\Models\NotifyUpload;
use App\Models\NotifyApproval;
use Notification;
use App\Notifications\uploadFormNotification;

class NotificationController extends Controller
{
  use ApiResponser;

  public function __construct()
    {
        // $this->middleware('auth');
    }
  
  public function sendOfferNotification() {
    $userSchema = User::first();

    $offerData = [
        'name' => 'ADMIN',
        'body' => 'New Uploaded Form.',
        'thanks' => 'Thank you',
        'offerText' => 'Check out the offer',
        'offerUrl' => url('/'),
        'offer_id' => 777
    ];
    $userSchema->notify(new uploadFormNotification($offerData));
    // dd($userSchema->notifications);
    
    return $this->success($offerData,"Success Send Notification");
  }

  public function userNew() {
    $UserNotif = NotifyUser::orderBy('id', 'DESC')->get();
    $panjang = NotifyUser::where('status', 0)->orderBy('id', 'DESC')->get();
    return $this->success(['listNotif' => $UserNotif, 'length' => count($panjang)]);
  }

  public function UploadNew() {
    $UploadNotif = NotifyUpload::orderBy('id', 'DESC')->get();
    $panjang = NotifyUpload::where('status', 0)->orderBy('id', 'DESC')->get();
    return $this->success(['listNotif' => $UploadNotif, 'length' => count($panjang)]);
  }

  public function ApprovalNew($userId) {
    $UploadNotif = NotifyApproval::where('user_id',$userId)->orderBy('id', 'DESC')->get();
    $panjang = NotifyApproval::where(['user_id' => $userId, 'status' => 0])->get();
    return $this->success(['listNotif' => $UploadNotif, 'length' => count($panjang)]);
  }

  public function userNewRead($id) {
    $UserNotif = NotifyUser::where('id',$id)->update(array('status' => 1));
    return $this->success(['listNotif' => $UserNotif]);
  }

  public function UploadNewRead($id) {
    $UploadNotif = NotifyUpload::where('id',$id)->update(array('status' => 1));
    return $this->success(['listNotif' => $UploadNotif]);
  }

  public function ApprovalNewRead($id) {
    $UploadNotif = NotifyApproval::where('id',$id)->update(array('status' => 1));
    return $this->success(['listNotif' => $UploadNotif]);
  }
}
