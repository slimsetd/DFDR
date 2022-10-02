<?php

namespace App\Http\Controllers\Api;


use Notification;

use App\Models\User;
use App\Models\Category;
use App\Models\UploadForm;
use App\Models\NotifyUpload;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\NotifyApproval;
use App\Models\UploadFormFile;
use App\Models\UploadFormType;
use App\Mail\ApprovalUploadForm;
use App\Mail\RejectedUploadForm;
use App\Mail\VerifiedUploadForm;
use App\Models\UploadFormFormat;
use App\Models\UploadFormSource;
use App\Models\UploadFormCreator;
use App\Models\UploadFormSubject;
use App\Models\UploadFormCoverage;
use App\Models\UploadFormDivision;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UploadFormIdentifier;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Models\UploadFormContributor;
use App\Notifications\uploadFormNotification;


class UploadFormController extends Controller
{
  use ApiResponser;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($sort = 'DESC')
  {
    // dd('masuk kemari');
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->orderBy('title', $sort)->orderBy('id', 'DESC')->get();
    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category = $category_name->category_name;

      $year = explode("-", $key->date);
      $key->year = $year[0];

      $str = strip_tags($key->description);
      if (strlen($str) > 35) {
        // truncate string
        $strCut = substr($str, 0, 35);
        $endPoint = strrpos($strCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $str = $endPoint ? substr($strCut, 0, $endPoint) : substr($strCut, 0);
        $str .= ' ..';
      }

      $key->description = $str;

      $str = "";
      for ($i = 0; $i < count($key->uploadFormCreator); $i++) {
        if ($i == 0)
          $str = $key->uploadFormCreator[$i]->creator;
        else
          $str = $str . ", " . $key->uploadFormCreator[$i]->creator;
      }

      $key->creator = $str;
      $key->file_name = (count($key->uploadFormFile) != 0) ? $key->uploadFormFile[0]->file_name : null;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function jsonGenerated()
  {
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->orderBy('id', 'DESC')->get();
    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return response()->json($uploadForm);
    // return $this->success(['form' => $uploadForm]);
  }

  public function showByUser()
  {
    // dd('masuk kadie');
    $user_id = Auth::User()->id;
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->where('user_id', $user_id)->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category = $category_name->category_name;

      $str = strip_tags($key->description);
      if (strlen($str) > 70) {

        // truncate string
        $strCut = substr($str, 0, 70);
        $endPoint = strrpos($strCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $str = $endPoint ? substr($strCut, 0, $endPoint) : substr($strCut, 0);
        $str .= ' ..';
      }

      $key->description = $str;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function showByThisMonth()
  {
    $start = date('Y-m') . "-01";
    $a_date = date('Y-m-d');
    $end = date("Y-m-t", strtotime($a_date));

    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )
      ->whereBetween('date', [$start, $end])
      ->orderBy('id', 'DESC')
      ->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category = $category_name->category_name;

      $str = strip_tags($key->description);
      if (strlen($str) > 35) {
        // truncate string
        $strCut = substr($str, 0, 35);
        $endPoint = strrpos($strCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $str = $endPoint ? substr($strCut, 0, $endPoint) : substr($strCut, 0);
        $str .= ' ..';
      }

      $key->description = $str;

      $str = "";
      for ($i = 0; $i < count($key->uploadFormCreator); $i++) {
        if ($i == 0)
          $str = $key->uploadFormCreator[$i]->creator;
        else
          $str = $str . ", " . $key->uploadFormCreator[$i]->creator;
      }

      $key->creator = $str;
      $key->file_name = (count($key->uploadFormFile) != 0) ? $key->uploadFormFile[0]->file_name : null;
    }

    return $this->success(['form' => $uploadForm]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $fields = $request->validate([
      'title' => "required",
      'category' => "required",
      'creator' => "required",
      'subject' => "required",
      'description' => "required",
      'publisher' => "required",
      'contributor' => "required",
      'date' => "required",
      'type' => "required",
      'format' => "required",
      'identifier' => "required",
      'source' => "required",
      'language' => "required",
      'relation' => "required",
      'coverage' => "required",
      // 'division_information' => "required",
      'file_upload.*' => "required",
      'user_id' => "required",
      'right_management' => "required",
      'upload_for' => "required",
    ]);
    // dd($request->file_upload);
    $upload_form = new UploadForm;
    $upload_form->title = $fields['title'];
    $upload_form->category = $fields['category'];
    $upload_form->description = $fields['description'];
    $upload_form->publisher = $fields['publisher'];
    $upload_form->date = $fields['date'];
    $upload_form->language = $fields['language'];
    $upload_form->relation = $fields['relation'];
    $upload_form->user_id = $fields['user_id'];
    $upload_form->right_management = $fields['right_management'];
    $upload_form->upload_for = $fields['upload_for'];
    $upload_form->total_download = "0-0";

    if ($fields['upload_for'] == 'Admin') {
      $upload_form->status = 'Approved';
    }

    $upload_form->save();

    $creator = json_decode($fields['creator'], true);
    $subject = json_decode($fields['subject'], true);
    $contributor = json_decode($fields['contributor'], true);
    $type = json_decode($fields['type'], true);
    $format = json_decode($fields['format'], true);
    $identifier = json_decode($fields['identifier'], true);
    $source = json_decode($fields['source'], true);
    $coverage = json_decode($fields['coverage'], true);
    // $division = json_decode($fields['division_information'], true);

    // $creator = explode(',', $fields['creator']);
    // // dd($creator);
    // $subject = explode(',', $fields['subject']);
    // $contributor = explode(',', $fields['contributor']);
    // $type = explode(',', $fields['type']);
    // $format = explode(',', $fields['format']);
    // $identifier = explode(',', $fields['identifier']);
    // $source = explode(',', $fields['source']);
    // $coverage = explode(',', $fields['coverage']);
    // $division = explode(',', $fields['division_information']);

    foreach ($creator as $key => $keyCreator) {
      $upload_form_creator = new UploadFormCreator;
      $upload_form_creator->creator = $keyCreator['creator_name'];
      $upload_form->uploadFormCreator()->save($upload_form_creator);
    }

    foreach ($subject as $key => $keySubject) {
      $upload_form_subject = new UploadFormSubject;
      $upload_form_subject->subject = $keySubject['subject_name'];
      $upload_form->uploadFormSubject()->save($upload_form_subject);
    }

    foreach ($contributor as $key => $keyContributor) {
      $upload_form_contributor = new UploadFormContributor;
      $upload_form_contributor->contributor = $keyContributor['contributor_name'];
      $upload_form->uploadFormContributor()->save($upload_form_contributor);
    }

    foreach ($type as $key => $keyType) {
      $upload_form_type = new UploadFormType;
      $upload_form_type->type = $keyType['type_name'];
      $upload_form->uploadFormType()->save($upload_form_type);
    }

    foreach ($format as $key => $keyFormat) {
      $upload_form_format = new UploadFormFormat;
      $upload_form_format->format = $keyFormat['format_name'];
      $upload_form->uploadFormFormat()->save($upload_form_format);
    }

    foreach ($identifier as $key => $keyIdentifier) {
      $upload_form_identifier = new UploadFormIdentifier;
      $upload_form_identifier->identifier = $keyIdentifier['identifier_name'];
      $upload_form->uploadFormIdentifier()->save($upload_form_identifier);
    }

    foreach ($source as $key => $keySource) {
      $upload_form_source = new UploadFormSource;
      $upload_form_source->source = $keySource['source_name'];
      $upload_form->uploadFormSource()->save($upload_form_source);
    }

    foreach ($coverage as $key => $keyCoverage) {
      $upload_form_coverage = new UploadFormCoverage;
      $upload_form_coverage->coverage = $keyCoverage['coverage_name'];
      $upload_form->uploadFormCoverage()->save($upload_form_coverage);
    }

    // foreach ($division as $key => $keyDivision) {
    //   $upload_form_division = new UploadFormDivision;
    //   $upload_form_division->Division = $keyDivision['division_information_name'];
    //   $upload_form->uploadFormDivision()->save($upload_form_division);
    // }

    if ($request->hasFile('file_upload')) {
      # code...
      if ($upload_form_file_image = $request->file_upload) {
        foreach ($upload_form_file_image as $key => $value) {
          // dd($value);
          $upload_form_file = new UploadFormFile;
          $upload_form_file->file_size = ($value->getSize() / 1000) . ' KB';
          if ($request->is_private[$key] == 1) {
            // storage_path('app/private_file/' . $file_name)
  
            $path = storage_path('app/private_file/');
            $value->move($path, $value->getClientOriginalName());
            $upload_form_file->is_private = $request->is_private[$key];
          } else {
            $path = public_path() . '/storage/uploads/file_upload';
            $value->move($path, $value->getClientOriginalName());
            $upload_form_file->is_private = $request->is_private[$key];
          }
          $upload_form_file->file = $path . '/' . $value->getClientOriginalName();
          $upload_form_file->file_name = $value->getClientOriginalName();
          $upload_form_file->file_extention = $value->getClientOriginalExtension();
          $upload_form->uploadFormFile()->save($upload_form_file);
        }
      }
    }

    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->find($upload_form->id);

    // dd($upload_form);

    // foreach ($uploadForm as $key ) {
    $category_name = Category::find($uploadForm->category);
    $uploadForm->category_name = $category_name->category_name;
    // }
    $userSchema = User::first();

    $offerData = [
      'name' => 'ADMIN',
      'body' => 'New Uploaded Form.',
      'thanks' => 'Thank you',
      'offerText' => 'Check out the offer',
      'offerUrl' => url('/'),
      'offer_id' => 666
    ];
    $userSchema->notify(new uploadFormNotification($offerData));

    $notif_upload = new NotifyUpload;
    $notif_upload->message = 'new deposit with tittle ' . $upload_form->title;
    $notif_upload->upload_form_id = $upload_form->id;
    $notif_upload->save();

    $user = User::find($fields['user_id']);

    $details = [
      'title' => $user->name,
      'body' => $fields['title']
    ];

    // Mail::to($user->email)->send(new ApprovalUploadForm($details));

    return $this->success(['form_upload' => $uploadForm], "Upload Form Success");
  }

  public function checkTitle(Request $request)
  {
    $request->validate([
      'title' => 'required',
    ]);

    if (UploadForm::where('title', '=', $request->title)->exists())
      return $this->error("data exist");
    else
      return $this->success(null, "data new");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // dd('masuk kesini');
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->find($id);

    $category_name = Category::find($uploadForm->category);
    $uploadForm->category_name = $category_name->category_name;
    return $this->success(['form' => $uploadForm]);
  }

  public function showById($id)
  {
    // dd('masuk kadie');
    // $user_id = Auth::User()->id;
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->where('user_id', $id)->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
      $key->file_name = (count($key->uploadFormFile) != 0) ? $key->uploadFormFile[0]->file_name : null;
    }

    return $this->success(['form' => $uploadForm]);
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
    $uploadForm = UploadForm::find($id);
    $uploadForm->update($request->all());
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->find($id);

    $category_name = Category::find($uploadForm->category);
    $uploadForm->category_name = $category_name->category_name;

    $userSchema = User::first();

    $user = User::find($uploadForm->user_id);

    if ($request->status == "Approved") {
      $notif_approve = new NotifyApproval;
      $notif_approve->message = 'deposit Approve with tittle - ' . $uploadForm->title . '- Approved';
      $notif_approve->deposit_id = $uploadForm->id;
      $notif_approve->user_id = $uploadForm->user_id;
      $notif_approve->save();

      $details = [
        'title' => $user->name,
        'body' => $uploadForm->title
      ];

      Mail::to($user->email)->send(new VerifiedUploadForm($details));

      $offerData = [
        'name' => 'ADMIN',
        'body' => 'Uploaded Form approved',
        'thanks' => 'Thank you',
        'offerText' => 'Check out the offer',
        'offerUrl' => url('/'),
        'offer_id' => 666
      ];
    } else {
      $notif_approve = new NotifyApproval;
      $notif_approve->message = 'deposit Reject with tittle ' . $uploadForm->title . '- Reject';
      $notif_approve->deposit_id = $uploadForm->id;
      $notif_approve->user_id = $uploadForm->user_id;
      $notif_approve->save();

      $details = [
        'title' => $user->name,
        'body' => $uploadForm->title,
        'reason' => $request->reason,
      ];

      Mail::to($user->email)->send(new RejectedUploadForm($details));

      $offerData = [
        'name' => 'ADMIN',
        'body' => 'Uploaded Form reject',
        'thanks' => 'Thank you',
        'offerText' => 'Check out the offer',
        'offerUrl' => url('/'),
        'offer_id' => 666
      ];
    }
    $userSchema->notify(new uploadFormNotification($offerData));
    // $request->Approved

    return $this->success(['form' => $uploadForm]);
  }

  public function updateData(Request $request, $id)
  {
    $uploadForm = UploadForm::find($id);

    $uploadForm->title = $request->title;
    $uploadForm->category = $request->category;
    $uploadForm->description = $request->description;
    $uploadForm->publisher = $request->publisher;
    $uploadForm->date = $request->date;
    $uploadForm->language = $request->language;
    $uploadForm->relation = $request->relation;
    $uploadForm->right_management = $request->right_management;

    $uploadForm->save();

    $creator = explode(',', $request->creator);
    $subject = explode(',', $request->subject);
    $contributor = explode(',', $request->contributor);
    $type = explode(',', $request->type);
    $format = explode(',', $request->format);
    $identifier = explode(',', $request->identifier);
    $source = explode(',', $request->source);
    $coverage = explode(',', $request->coverage);
    // $division = explode(',', $request->division_information);

    $i = 0;
    foreach ($creator as $key) { // 1 (0)
      $getData = UploadFormCreator::where('upload_form_id', '=', $id)->get(); // 2 (0,1)

      if ($i <= (count($getData) - 1)) {
        $upload_form_creator = UploadFormCreator::find($getData[$i]->id);
        $upload_form_creator->creator = $key;
        $uploadForm->uploadFormCreator()->save($upload_form_creator);

        // creator loop reached limit & lenght less than get data..
        if ($i == (count($creator) - 1) && count($creator) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++) {
            $upload_form_creator = UploadFormCreator::destroy($getData[$j]->id);
          }
        }
      } else {
        $upload_form_creator = new UploadFormCreator;
        $upload_form_creator->creator = $key;
        $uploadForm->uploadFormCreator()->save($upload_form_creator);
      }

      $i++;
    }

    $i = 0;
    foreach ($subject as $key) {
      $getData = UploadFormSubject::where('upload_form_id', '=', $id)->get(); // 2 (0,1)

      if ($i <= (count($getData) - 1)) {
        $upload_form_subject = UploadFormSubject::find($getData[$i]->id);
        $upload_form_subject->subject = $key;
        $uploadForm->uploadFormSubject()->save($upload_form_subject);

        // loop reached limit & lenght less than get data..
        if ($i == (count($subject) - 1) && count($subject) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_subject = UploadFormSubject::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_subject = new UploadFormSubject;
        $upload_form_subject->subject = $key;
        $uploadForm->uploadFormSubject()->save($upload_form_subject);
      }

      $i++;
    }

    $i = 0;
    foreach ($contributor as $key) {
      $getData = UploadFormContributor::where('upload_form_id', '=', $id)->get();

      if ($i <= (count($getData) - 1)) {
        $upload_form_contributor = UploadFormContributor::find($getData[$i]->id);
        $upload_form_contributor->contributor = $key;
        $uploadForm->uploadFormContributor()->save($upload_form_contributor);

        // loop reached limit & lenght less than get data..
        if ($i == (count($contributor) - 1) && count($contributor) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_contributor = UploadFormContributor::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_contributor = new UploadFormContributor;
        $upload_form_contributor->contributor = $key;
        $uploadForm->uploadFormContributor()->save($upload_form_contributor);
      }

      $i++;
    }

    $i = 0;
    foreach ($type as $key) {
      $getData = UploadFormType::where('upload_form_id', '=', $id)->get();

      if ($i <= (count($getData) - 1)) {
        $upload_form_type = UploadFormType::find($getData[$i]->id);
        $upload_form_type->type = $key;
        $uploadForm->uploadFormType()->save($upload_form_type);

        // loop reached limit & lenght less than get data..
        if ($i == (count($type) - 1) && count($type) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_type = UploadFormType::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_type = new UploadFormType;
        $upload_form_type->type = $key;
        $uploadForm->uploadFormType()->save($upload_form_type);
      }

      $i++;
    }

    $i = 0;
    foreach ($format as $key) {
      $getData = UploadFormFormat::where('upload_form_id', '=', $id)->get();

      if ($i <= (count($getData) - 1)) {
        $upload_form_format = UploadFormFormat::find($getData[$i]->id);
        $upload_form_format->format = $key;
        $uploadForm->uploadFormFormat()->save($upload_form_format);

        // loop reached limit & lenght less than get data..
        if ($i == (count($format) - 1) && count($format) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_format = UploadFormFormat::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_format = new UploadFormFormat;
        $upload_form_format->format = $key;
        $uploadForm->uploadFormFormat()->save($upload_form_format);
      }

      $i++;
    }

    $i = 0;
    foreach ($identifier as $key) {
      $getData = UploadFormIdentifier::where('upload_form_id', '=', $id)->get();

      if ($i <= (count($getData) - 1)) {
        $upload_form_identifier = UploadFormIdentifier::find($getData[$i]->id);
        $upload_form_identifier->identifier = $key;
        $uploadForm->uploadFormIdentifier()->save($upload_form_identifier);

        // loop reached limit & lenght less than get data..
        if ($i == (count($identifier) - 1) && count($identifier) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_identifier = UploadFormIdentifier::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_identifier = new UploadFormIdentifier;
        $upload_form_identifier->identifier = $key;
        $uploadForm->uploadFormIdentifier()->save($upload_form_identifier);
      }

      $i++;
    }

    $i = 0;
    foreach ($source as $key) {
      $getData = UploadFormSource::where('upload_form_id', '=', $id)->get();

      if ($i <= (count($getData) - 1)) {
        $upload_form_source = UploadFormSource::find($getData[$i]->id);
        $upload_form_source->source = $key;
        $uploadForm->uploadFormSource()->save($upload_form_source);

        // loop reached limit & lenght less than get data..
        if ($i == (count($source) - 1) && count($source) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_source = UploadFormSource::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_source = new UploadFormSource;
        $upload_form_source->source = $key;
        $uploadForm->uploadFormSource()->save($upload_form_source);
      }

      $i++;
    }

    $i = 0;
    foreach ($coverage as $key) {
      $getData = UploadFormCoverage::where('upload_form_id', '=', $id)->get();

      if ($i <= (count($getData) - 1)) {
        $upload_form_coverage = UploadFormCoverage::find($getData[$i]->id);
        $upload_form_coverage->coverage = $key;
        $uploadForm->uploadFormCoverage()->save($upload_form_coverage);

        // loop reached limit & lenght less than get data..
        if ($i == (count($coverage) - 1) && count($coverage) < count($getData)) {
          for ($j = $i + 1; $j < count($getData); $j++)
            $upload_form_coverage = UploadFormCoverage::destroy($getData[$j]->id);
        }
      } else {
        $upload_form_coverage = new UploadFormCoverage;
        $upload_form_coverage->coverage = $key;
        $uploadForm->uploadFormCoverage()->save($upload_form_coverage);
      }

      $i++;
    }

    $i = 0;
    // foreach ($division as $key) {
    //   $getData = UploadFormDivision::where('upload_form_id', '=', $id)->get();

    //   if ($i <= (count($getData)-1))
    //   {
    //     $upload_form_division = UploadFormDivision::find($getData[$i]->id);
    //     $upload_form_division->Division = $key;
    //     $uploadForm->uploadFormDivision()->save($upload_form_division);

    //     // loop reached limit & lenght less than get data..
    //     if ($i == (count($division)-1) && count($division) < count($getData))
    //     {
    //       for ($j = $i+1; $j < count($getData); $j++)
    //         $upload_form_division = UploadFormDivision::destroy($getData[$j]->id);
    //     }
    //   }
    //   else
    //   {
    //     $upload_form_division = new UploadFormDivision;
    //     $upload_form_division->Division = $key;
    //     $uploadForm->uploadFormDivision()->save($upload_form_division);
    //   }

    //   $i++;
    // }

    // if ($request->file('upload_card') != "")
    // {
    //   if ($upload_form_file_image = $request->file('upload_card')) 
    //   {
    //     $getData = UploadFormFile::where('upload_form_id', '=', $id)->get();

    //     $path = public_path() . '/storage/uploads/file_upload';
    //     $upload_form_file_image->move($path, $upload_form_file_image->getClientOriginalName());

    //     // dd($upload_form_file_image);

    //     $upload_form_file = UploadFormFile::find($getData[0]->id);
    //     $upload_form_file->file_size = 'KB';
    //     $upload_form_file->file =$path.'/'.$upload_form_file_image->getClientOriginalName();
    //     $upload_form_file->file_name = $upload_form_file_image->getClientOriginalName();
    //     $upload_form_file->file_extention = $upload_form_file_image->getClientOriginalExtension();
    //     $uploadForm->uploadFormFile()->save($upload_form_file);

    //     // foreach ($upload_form_file_image as $key => $value) {
    //     //   // dd($value);
    //     //   $upload_form_file = new UploadFormFile;
    //     //   $upload_form_file->file_size = ($value->getSize() / 1000) .' KB';
    //     //   $path = public_path() . '/storage/uploads/file_upload';
    //     //   $value->move($path, $value->getClientOriginalName());
    //     //   $upload_form_file->file =$path.'/'.$value->getClientOriginalName();
    //     //   $upload_form_file->file_name = $value->getClientOriginalName();
    //     //   $upload_form_file->file_extention = $value->getClientOriginalExtension();
    //     //   $upload_form->uploadFormFile()->save($upload_form_file);
    //     // }
    //   }
    // }

    // dd($uploadForm->uploadFormfile);
    if ($upload_form_file_image = $request->file_upload) {
      foreach ($upload_form_file_image as $key => $value) {
        // dd($value);
        $upload_form_file = new UploadFormFile;
        $upload_form_file->file_size = ($value->getSize() / 1000) . ' KB';
        if ($request->is_private[$key] == 1) {
          // storage_path('app/private_file/' . $file_name)

          $path = storage_path('app/private_file/');
          $value->move($path, $value->getClientOriginalName());
          $upload_form_file->is_private = $request->is_private[$key];
        } else {
          $path = public_path() . '/storage/uploads/file_upload';
          $value->move($path, $value->getClientOriginalName());
          $upload_form_file->is_private = $request->is_private[$key];
        }
        $upload_form_file->file = $path . '/' . $value->getClientOriginalName();
        $upload_form_file->file_name = $value->getClientOriginalName();
        $upload_form_file->file_extention = $value->getClientOriginalExtension();
        $uploadForm->uploadFormFile()->save($upload_form_file);
      }
    }

    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->find($id);

    return $this->success(['testing' => $uploadForm]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $uploadForm = UploadForm::destroy($id);
    return $this->success(['form' => $uploadForm]);
  }

  public function storeFile(Request $request)
  {
    $upload_form = UploadForm::find($request->upload_form_id);
    // $storeFile = $upload_form->uploadFormFile()->create([
    $upload_form_file = new UploadFormFile;
    $value = $request->file_upload;
    $upload_form_file->file_size = ($value->getSize() / 1000) . ' KB';
    if ($request->is_private == 1) {
      // storage_path('app/private_file/' . $file_name)

      $path = storage_path('app/private_file/');
      $value->move($path, $value->getClientOriginalName());
      $upload_form_file->is_private = $request->is_private;
    } else {
      $path = public_path() . '/storage/uploads/file_upload';
      $value->move($path, $value->getClientOriginalName());
      $upload_form_file->is_private = $request->is_private;
    }
    $upload_form_file->file = $path . '/' . $value->getClientOriginalName();
    $upload_form_file->file_name = $value->getClientOriginalName();
    $upload_form_file->file_extention = $value->getClientOriginalExtension();
    $upload_form->uploadFormFile()->save($upload_form_file);
    return $upload_form;
    // ]);
    # code...
  }
  public function updateFile(Request $request)
  {
    // dd($request->file_id);
    $value = $request->file_upload;
    if ($request->file_id != "null") {
      $upload_form_file = UploadFormFile::find($request->file_id);
      // $storeFile = $upload_form->uploadFormFile()->create([
      // $upload_form_file = new UploadFormFile;
    
  
      if ($request->is_private == 1) {
        // storage_path('app/private_file/' . $file_name)
  
        $path = storage_path('app/private_file/');
        $value->move($path, $value->getClientOriginalName());
        // $upload_form_file->is_private = $request->is_private;
        // $upload_form_file->update([
        //   'is_private' => $request->is_private
        // ]);
      } else {
        $path = public_path() . '/storage/uploads/file_upload';
        $value->move($path, $value->getClientOriginalName());
        // $upload_form_file->is_private = $request->is_private;
        // $upload_form_file->update([
        //   'is_private' => $request->is_private
        // ]);
      }
  
  
        # code...
        $upload_form_file->update([
          'is_private' => $request->is_private,
          // 'file_size' => (File::size($value)/ 1000) . ' KB',
          'file_size' => '1000 KB',
          'file' => $path . '/' . $value->getClientOriginalName(),
          'file_name' => $value->getClientOriginalName(),
          'file_extention' => $value->getClientOriginalExtension()
        ]);
        // $upload_form_file->update($upload_form_file);
        return $upload_form_file;
      
    }else{
      
            // $upload_form_file = UploadFormFile;
            // $upload_form_file->file_size = ($value->getSize() / 1000) . ' KB';
            if ($request->is_private == 1) {
              // storage_path('app/private_file/' . $file_name)
    
              $path = storage_path('app/private_file/');
              $value->move($path, $value->getClientOriginalName());
              // $upload_form_file->is_private = $request->is_private;
            } else {
              $path = public_path() . '/storage/uploads/file_upload';
              $value->move($path, $value->getClientOriginalName());
              // $upload_form_file->is_private = $request->is_private;
            }
        
             $store = UploadFormFile::create([
              'upload_form_id' => $request->form_id,
              'file' => $path . '/' . $value->getClientOriginalName(),
              'file_name' => $value->getClientOriginalName(),
              'file_size' => '1000 KB',
              'file_extention' => $value->getClientOriginalExtension(),
              'is_private' => $request->is_private,

            ]);

            return $store;
         
        
      
    }
 
    // ]);
    # code...
  }

  public function destroyFile($id)
  {
    $data = UploadFormFile::destroy($id);
    // foreach ($data->UploadFormFile as $file) {
    //   dd($file);
    // //  if ($file->id == $id) {
    // //   UploadFormFile::destroy($file->id);
    // //  }
    // }
    // $uploadForm = $data->delete();
    return $this->success(['form' => $data]);
  }

  /**
   * Search for a name
   *
   * @param  str  $name
   * @return \Illuminate\Http\Response
   */
  public function searchByYear($year, $sort = 'DESC')
  {
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->whereHas('users', function ($query) use ($year) {
      $query->where('years', $year);
    })
      ->with("users")->where('status', 'Approved')->orderBy('title', $sort)->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function searchByTitle($title, $sort = 'DESC')
  {
    // $uploadForm = UploadForm::where('title', 'like', '%'.$title.'%')->orderBy('id', 'DESC')->get();
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->where('title', 'like', '%' . $title . '%')->where('status', 'Approved')->orderBy('title', $sort)->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function searchByCreator($creator, $sort = 'DESC')
  {
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->whereHas('uploadFormCreator', function ($query) use ($creator) {
      $query->where('creator', $creator);
    })
      ->with("uploadFormCreator")->orderBy('title', $sort)->orderBy('id', 'DESC')->where('status', 'Approved')->get();
    // $uploadForm = UploadForm::where('creator', 'like', '%'.$creator.'%')->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function searchByCategory($category, $sort = 'DESC')
  {
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->where('status', 'Approved')->where('category', $category)->orderBy('title', $sort)->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function searchByStatus($status, $sort = 'DESC')
  {
    $uploadForm = UploadForm::with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->where('status', $status)->orderBy('title', $sort)->orderBy('id', 'DESC')->get();

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
      $key->category = $category_name->category_name;

      $year = explode("-", $key->date);
      $key->year = $year[0];

      $str = strip_tags($key->description);
      if (strlen($str) > 70) {
        // truncate string
        $strCut = substr($str, 0, 70);
        $endPoint = strrpos($strCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $str = $endPoint ? substr($strCut, 0, $endPoint) : substr($strCut, 0);
        $str .= ' ..';
      }

      $key->description = $str;

      $str = "";
      for ($i = 0; $i < count($key->uploadFormCreator); $i++) {
        if ($i == 0)
          $str = $key->uploadFormCreator[$i]->creator;
        else
          $str = $str . ", " . $key->uploadFormCreator[$i]->creator;
      }

      $key->creator = $str;
      $key->file_name = (count($key->uploadFormFile) != 0) ? $key->uploadFormFile[0]->file_name : null;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function searchGlobal($search, $sort = 'DESC')
  {
    $columnsToSearch = [
      'title',
      'category',
      'description',
      'publisher',
      'date',
      'language',
      'relation',
      'status',
    ];

    $searchQuery = '%' . $search . '%';

    $uploadForm = UploadForm::where('id', 'LIKE', $searchQuery);

    foreach ($columnsToSearch as $column) {
      $uploadForm = $uploadForm->where('status', 'Approved')->orWhere($column, 'LIKE', $searchQuery);
    }

    $uploadForm = $uploadForm->with(
      'users',
      'uploadFormCreator',
      'uploadFormSubject',
      'uploadFormContributor',
      'uploadFormType',
      'uploadFormFormat',
      'uploadFormIdentifier',
      'uploadFormSource',
      'uploadFormCoverage',
      'uploadFormDivision',
      'uploadFormFile'
    )->orderBy('title', $sort)->orderBy('id', 'DESC')->get();
    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return $this->success(['form' => $uploadForm]);
  }

  public function downloadIncrement(Request $request, $id)
  {
    $upload_form = UploadForm::find($id);
    $arr = explode("-", $upload_form->total_download);

    if ($request->click == "Download") {
      $inc = (int)$arr[0] + 1;
      $upload_form->total_download = $inc . "-" . $arr[1];
      $upload_form->save();
    } else if ($request->click == "View") {
      $inc = (int)$arr[1] + 1;
      $upload_form->total_download = $arr[0] . "-" . $inc;
      $upload_form->save();
    }

    return $this->success(['form' => $request->click]);

    // ->update([
    //   'total_download'=> DB::raw('total_download+1')
    // ]);
  }



  public function newSearchGlobal($search)
  {
    // $search = "%". $request->exists('search') ? $request->search : '' ."%";
    $search = "%" . $search . "%";
    $UploadForm = UploadForm::where('status', 'approved')
      ->where('id', 'LIKE', $search)
      ->orWhere('relation', 'LIKE', $search)
      ->orWhere('language', 'LIKE', $search)
      ->orWhere('language', 'LIKE', $search)
      ->orWhere('description', 'LIKE', $search)
      ->orWhere('category', 'LIKE', $search)
      ->orWhere('title', 'LIKE', $search)
      // ->whereBetween('date', [$request->exists('search') ? $request->search : '', $request->exists('search') ? $request->search : ''])
      ->with('uploadFormCreator')
      ->orWhereHas('uploadFormCreator', function ($q)  use ($search) {
        $q->where('creator', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormSubject', function ($q)  use ($search) {
        $q->where('subject', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormContributor', function ($q)  use ($search) {
        $q->where('contributor', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormType', function ($q)  use ($search) {
        $q->where('type', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormFormat', function ($q)  use ($search) {
        $q->where('format', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormIdentifier', function ($q)  use ($search) {
        $q->where('identifier', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormSource', function ($q)  use ($search) {
        $q->where('source', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormCoverage', function ($q)  use ($search) {
        $q->where('coverage', 'LIKE', $search);
      })
      ->orWhereHas('uploadFormDivision', function ($q)  use ($search) {
        $q->where('division', 'LIKE', $search);
      })
      ->get();
    return $this->success(['form' => $UploadForm]);
  }

  public function newSearchPerHit(Request $request)
  {
    $UploadForm = UploadForm::where('status', 'approved')
      ->where([
        ['title', 'LIKE', "%$request->exists('title') ? $request->title : ''%"],
        ['category', 'LIKE', "%$request->exists('category') ? $request->category : ''%"],
        ['description', 'LIKE', "%$request->exists('description') ? $request->description : ''%"],
        ['publisher', 'LIKE', "%$request->exists('publisher') ? $request->publisher : ''%"],
        ['language', 'LIKE', "%$request->exists('language') ? $request->language : ''%"],
        ['relation', 'LIKE', "%$request->exists('relation') ? $request->relation : ''%"],
      ])
      ->whereBetween('date', [$request->exists('start_date') ? $request->start_date : '', $request->exists('end_date') ? $request->end_date : ''])
      ->with('uploadFormCreator')
      ->whereHas('uploadFormCreator', function ($q)  use ($request) {
        $q->where('creator', 'LIKE', "%$request->exists('creator') ? $request->creator : ''%");
      })
      ->whereHas('uploadFormSubject', function ($q)  use ($request) {
        $q->where('subject', 'LIKE', "%$request->exists('subject') ? $request->subject : ''%");
      })
      ->whereHas('uploadFormContributor', function ($q)  use ($request) {
        $q->where('contributor', 'LIKE', "%$request->exists('contributor') ? $request->contributor : ''%");
      })
      ->whereHas('uploadFormType', function ($q)  use ($request) {
        $q->where('type', 'LIKE', "%$request->exists('type') ? $request->type : ''%");
      })
      ->whereHas('uploadFormFormat', function ($q)  use ($request) {
        $q->where('format', 'LIKE', "%$request->exists('format') ? $request->format : ''%");
      })
      ->whereHas('uploadFormIdentifier', function ($q)  use ($request) {
        $q->where('identifier', 'LIKE', "%$request->exists('identifier') ? $request->identifier : ''%");
      })
      ->whereHas('uploadFormSource', function ($q)  use ($request) {
        $q->where('source', 'LIKE', "%$request->exists('source') ? $request->source : ''%");
      })
      ->whereHas('uploadFormCoverage', function ($q)  use ($request) {
        $q->where('coverage', 'LIKE', "%$request->exists('coverage') ? $request->coverage : ''%");
      })
      ->whereHas('uploadFormDivision', function ($q)  use ($request) {
        $q->where('division', 'LIKE', "%$request->exists('division') ? $request->division : ''%");
      })
      ->get();
    return $this->success(['form' => $UploadForm]);
  }

  public function newSearchGlobalTitle(Request $request)
  {
    // '%' . $search . '%';
    $UploadForm = UploadForm::where('status', 'Approved')
      ->with(
        'users',
        'uploadFormCreator',
        'uploadFormSubject',
        'uploadFormContributor',
        'uploadFormType',
        'uploadFormFormat',
        'uploadFormIdentifier',
        'uploadFormSource',
        'uploadFormCoverage',
        'uploadFormDivision',
        'uploadFormFile'
      );
    if ($request->exists('title')) {
      $UploadForm = $UploadForm->where('title', 'LIKE',  "%" . $request->title . "%");
    }
    if ($request->exists('start_date') && $request->exists('end_date')) {
      $UploadForm = $UploadForm->whereBetween('date', [$request->start_date, $request->end_date]);
    }
    if ($request->exists('this_month')) {
      $start = date('Y-m') . "-01";
      $a_date = date('Y-m-d');
      $end = date("Y-m-t", strtotime($a_date));

      $UploadForm = $UploadForm->whereBetween('date', [$start, $end]);
    }
    if ($request->exists('category')) {
      $UploadForm = $UploadForm->where('category', $request->category);
    }
    if ($request->exists('right_management')) {
      $UploadForm = $UploadForm->where('right_management', $request->right_management);
    }
    if ($request->exists('subject')) {
      $UploadForm = $UploadForm->whereHas('uploadFormSubject', function ($q)  use ($request) {
        $q->where('subject', 'LIKE', "%" . $request->subject . "%");
      });
    }
    if ($request->exists('type')) {
      $UploadForm = $UploadForm->whereHas('uploadFormType', function ($q)  use ($request) {
        $q->where('type', 'LIKE', "%" . $request->type . "%");
      });
    }
    if ($request->exists('creator')) {
      $UploadForm = $UploadForm->whereHas('uploadFormCreator', function ($q)  use ($request) {
        $q->where('creator', 'LIKE', "%" . $request->creator . "%");
      });
    }
    $UploadForm = $UploadForm->get();
    foreach ($UploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;
    }
    return $this->success(['form' => $UploadForm]);
  }
}
