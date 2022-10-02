<?php

namespace App\Http\Controllers\Api;

use PDF;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\User;

use App\Models\Year;

use App\Models\Report;
use App\Models\Faculty;
use App\Models\Version;
use App\Models\Category;
use App\Models\Language;
use App\Models\Department;
use App\Models\JsonReport;
use App\Models\UploadForm;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Exports\DepositExport;
use App\Exports\SubjectsExport;
use App\Models\UploadFormType;

use App\Models\UploadFormCreator;
use App\Models\UploadFormSubject;
use App\Models\UploadFormDivision;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\SubjectImport;
use App\Imports\UploadFormImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
  use ApiResponser;

  public function index()
  {
    $countAllDeposit = UploadForm::get()->count();
    $countDepositByDivision = UploadFormDivision::distinct()->count('division');
    $countAllUser = User::where('role', 'User')->get()->count();
    $countAllCreator = UploadFormCreator::distinct()->count('creator');
    $countAllEditor = User::where('role', 'Editor')->get()->count();
    $countAllDepositByCat = UploadForm::distinct()->count('category');

    ////users///
    $countAllDepositApproved = UploadForm::get()->where('status', 'Approved')->count();
    $countMyDeposit = UploadForm::get()->where('user_id', Auth::User()->id)->where('status', 'Approved')->count();

    return $this->success(
      [
        'all_file_upload' => $countAllDeposit,
        'all_file_upload_by_division' => $countDepositByDivision,
        'all_user' => $countAllUser,
        'all_creator' => $countAllCreator,
        'all_editor' => $countAllEditor,
        'all_file_upload_by_category' => $countAllDepositByCat,

        'all_file_upload_approve' => $countAllDepositApproved,
        'my_file_upload_deposite' => $countMyDeposit,
      ]
    );
  }

  // public function indexforuser(){
  //   $countAllDeposit = UploadForm::get()->where('status', 'Approved')->count();
  //   $countMyDeposit = UploadForm::get()->where('user_id', Auth::User()->id)->where('status', 'Approved')->count();
  //   return $this->success(
  //     [
  //       'all_file_upload' => $countAllDeposit,
  //       'my_file_upload' => $countMyDeposit,
  //     ]
  //   );
  // }

  public function ShowCreator()
  {
    $data = UploadFormCreator::distinct()
      ->orderBy('creator', 'ASC')
      ->get('creator');
    return $this->success(
      [
        'data' => $data,
      ]
    );
  }

  public function ShowType()
  {
    $data = UploadFormType::distinct()->get('type');
    return $this->success(
      [
        'data' => $data,
      ]
    );
  }

  public function ShowSubject()
  {
    $data = UploadFormSubject::distinct()->get('subject');
    return $this->success(
      [
        'data' => $data,
      ]
    );
  }

  public function ShowDivision()
  {
    $data = UploadFormDivision::distinct()->get('division');
    return $this->success(
      [
        'data' => $data,
      ]
    );
  }

  public function ShowEditor()
  {
    $countAllEditor = User::where('role', 'Editor')->get();
    return $this->success(
      [
        'data' => $countAllEditor
      ]
    );
  }

  public function ShowVersion()
  {
    $version = Version::orderBy('id', 'DESC')->get();
    return $this->success(
      [
        'data' => $version
      ]
    );
  }

  public function ExportDB()
  {
    //ENTER THE RELEVANT INFO BELOW
    $mysqlHostName  = env('DB_HOST');
    $mysqlUserName  = env('DB_USERNAME');
    $mysqlPassword  = env('DB_PASSWORD');
    $DbName         = env('DB_DATABASE');
    $backup_name    = "mybackup.sql";

    $get_all_table_query = "SHOW TABLES ";
    $result = DB::select(DB::raw($get_all_table_query));

    $prep = "Tables_in_$DbName";
    foreach ($result as $res) {
      $tables[] =  $res->$prep;
    }

    $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword", array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $get_all_table_query = "SHOW TABLES";
    $statement = $connect->prepare($get_all_table_query);
    $statement->execute();
    $result = $statement->fetchAll();


    $output = '';
    foreach ($tables as $table) {
      $show_table_query = "SHOW CREATE TABLE " . $table . "";
      $statement = $connect->prepare($show_table_query);
      $statement->execute();
      $show_table_result = $statement->fetchAll();

      foreach ($show_table_result as $show_table_row) {
        $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
      }
      $select_query = "SELECT * FROM " . $table . "";
      $statement = $connect->prepare($select_query);
      $statement->execute();
      $total_row = $statement->rowCount();

      for ($count = 0; $count < $total_row; $count++) {
        $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
        $table_column_array = array_keys($single_result);
        $table_value_array = array_values($single_result);
        $output .= "\nINSERT INTO $table (";
        $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
        $output .= "'" . implode("','", str_replace("'", "''", $table_value_array)) . "');\n";
      }
    }
    $file_name = 'database_backup.sql';
    $file_handle = fopen($file_name, 'w+');
    fwrite($file_handle, $output);
    fclose($file_handle);

    File::move($file_name, 'downloads/db/' . $file_name);

    // header('Content-Description: File Transfer');
    // header('Content-Type: application/octet-stream');
    // header('Content-Disposition: attachment; filename=' . basename($file_name));
    // header('Content-Transfer-Encoding: binary');
    // header('Expires: 0');
    // header('Cache-Control: must-revalidate');
    // header('Pragma: public');
    // header('Content-Length: ' . filesize($file_name));
    // ob_clean();
    // flush();
    // readfile($file_name);
    // unlink($file_name);

    return $this->success([
      'data' => $file_name
    ]);
  }

  public function countGroupCategory()
  {
    $listCount = DB::table('upload_form')
      ->select('category', DB::raw('count(*) as total'))
      ->groupBy('category')
      ->where('status', 'Approved')
      ->get();
    foreach ($listCount as $key => $value) {
      // dd($value);
      $value->category_name = Category::select('category_name')->where('id', $value->category)->first();
    }
    return $this->success(
      [
        'all_list' => $listCount,
      ]
    );
  }

  public function depositReportFilter(Request $request)
  {
    $fields = $request->validate([
      'startDate' => "required",
      'endDate' => "required",
      'category' => "required",
      'division' => "required",
    ]);
    $deposit = UploadForm::whereHas('uploadFormDivision', function ($query) use ($fields) {
      $query->where('division', 'like', '%' . $fields['division'] . '%');
    })
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
      )
      ->where('category', $fields['category'])
      ->where('date', '>=', $fields['startDate'])
      ->where('date', '<=', $fields['endDate'])
      ->orderBy('id', 'DESC')
      ->get();
    return $this->success(
      [
        'deposit_by_filter' => $deposit,
      ]
    );
  }

  public function depositReportChart(Request $request)
  {
    $fields = $request->validate([
      'years' => "required",
      'faculty' => "required",
      'category' => "required",
    ]);
    $chart = User::with(['uploadForm' => function ($query) use ($fields) {
      $query->where('category', $fields['category']);
    }])
      ->where('years', 'like', '%' . $fields['years'] . '%')
      ->where('faculty', 'like', '%' . $fields['faculty'] . '%')
      ->where('role', 'like', '%' . 'User' . '%')
      ->orderBy('years', 'ASC')
      ->get();
    return $this->success(
      [
        'chart_data' => $chart,
      ]
    );
  }

  public function depositReportChartBar(Request $request)
  {
    $begin = new DateTime($request->startDate);
    $end = new DateTime($request->endDate);

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    $date = array();
    $totalDataAll = array();
    $totalDataPending = array();
    $totalDataReject = array();
    $totalDataApproved = array();
    foreach ($period as $dt) {
      $allDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->get()->count();
      $PendingDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->where('status', 'Pending')->get()->count();
      $ApprovedDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->where('status', 'Approved')->get()->count();
      $RejectDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->where('status', 'Reject')->get()->count();
      array_push($date, $dt->format("Y-m-d"));
      array_push($totalDataAll, $allDataByDate);
      array_push($totalDataPending, $PendingDataByDate);
      array_push($totalDataApproved, $ApprovedDataByDate);
      array_push($totalDataReject, $RejectDataByDate);
    }
    $data_status = UploadForm::whereBetween('date', [$begin, $end])->exists();
    return $this->success(
      [
        'chart_data' => [
          'status' => ['Approved', 'Reject', 'Pending'],
          'date' => $date,
          'totalDataAll' => $totalDataAll,
          'totalDataPending' => $totalDataPending,
          'totalDataReject' => $totalDataReject,
          'totalDataApproved' => $totalDataApproved,
        ],
        'data_status' => $data_status
      ]
    );
  }

  public function depositReportChartYear(Request $request)
  {
    $totalDataByYear = array();
    $year = Year::select('year')->get();

    $gtYear = [];
    $uid = UploadForm::select('date')->get();
    foreach ($uid as $i) {
      array_push($gtYear, $i->date);
    }

    foreach ($year as $val) {

      $output = array_map(function ($val) {
        $dt = explode("-", $val);
        return $dt[0];
      }, $gtYear);

      $count = array_count_values($output);
      $resCount = (array_key_exists($val->year, $count)) ? $count[$val->year] : 0;
      $val->total = $resCount;
    }

    return $this->success(['chart_data' => ['year' => $year]]);
  }

  public function depositReportChartEditorContribution(Request $request)
  {
    $totalDataByYear = array();
    $user = User::select('id', 'name')->where('role', 'Editor')->get();
    $uid = UploadForm::select('user_id')->get();

    $gtId = [];

    foreach ($uid as $i) {
      array_push($gtId, $i->user_id);
    }

    foreach ($user as $val) {

      //   $output = array_map(function($val) { 
      //     $dt = explode("-", $val);
      //     return $dt[0]; 
      //   }, $gtYear);

      $count = array_count_values($gtId);
      $resCount = (array_key_exists($val->id, $count)) ? $count[$val->id] : 0;
      $val->total = $resCount;
    }

    return $this->success(['chart_data' => ['editor' => $user]]);
  }

  public function depositReportChartFaculty(Request $request)
  {
    // $facultyData = array();
    // $facultyColor = array();
    // $facultyDataTotal = array();
    $totalDataByFaculty = array();
    $faculty = Faculty::select('id', 'faculty_name')->get();
    foreach ($faculty as $key => $value) {
      $theFaculty = strtolower($value->faculty_name);
      // dd($theFaculty);

      // $allDataByfaculty = UploadForm::with('users')->whereHas('users', function($query) use ($theFaculty) {
      //   $query->where('faculty', $theFaculty);
      // })->get()->count();

      // [0,0,0,0,1]
      $uid = UploadForm::select('user_id')->get();
      $arr = [];
      $count = 0;
      $allDataByfaculty = [];

      // [2,2,2,2,1]
      for ($i = 0; $i < count($uid); $i++) {
        $usr = User::find($uid[$i]->user_id);
        array_push($arr, $usr->faculty);
      }

      $allDataByfaculty = array_count_values($arr);
      $val_id = (array_key_exists($value->id, $allDataByfaculty)) ? $allDataByfaculty[$value->id] : 0;

      $value->total = $val_id;
      $hash = md5('color' . $value->id);
      $rgb = array(hexdec(substr($hash, 0, 2)), hexdec(substr($hash, 2, 2)), hexdec(substr($hash, 4, 2)));
      $value->rgb = "rgb(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ")";
      //   array_push($facultyData,$value->faculty_name);
      //   $theFaculty = strtolower($value->faculty_name);
      //   $allDataByfaculty = UploadForm::whereHas('users', function($query) use ($theFaculty) {
      //               $query->where('faculty', $theFaculty);
      //             })->get()->count();
      //   array_push($facultyColor,"rgb(".$rgb[0].", ".$rgb[1].", ".$rgb[2].")");  
      // array_push($totalDataByFaculty,$allDataByfaculty);
      //   $question->opciones[] = [
      //     'id' => $value,
      //     'option' => $value
      // ];
    }

    return $this->success(
      [
        'chart_data' => [
          'faculty' => $faculty,
          // 'totalData' => $totalDataByFaculty,
          // 'color' => $facultyColor
        ],
      ]
    );
  }

  public function depositReportChartBarCategory(Request $request)
  {
    // $categoryData = array();
    // $categoryColor = array();
    // $categoryDataTotal = array();
    $totalDataByCategory = array();
    $category = Category::select('id', 'category_name')->get();

    foreach ($category as $key => $value) {
      $hash = md5('color' . $value->id);
      $rgb = array(hexdec(substr($hash, 0, 2)), hexdec(substr($hash, 2, 2)), hexdec(substr($hash, 4, 2)));
      //   array_push($categoryData,$value->category_name);
      $theCategory = strtolower($value->id);
      // $value->category_name = ;
      $allDataByCategory = UploadForm::where('category', $theCategory)->get()->count();
      $value->total = $allDataByCategory;
      $value->rgb = "rgb(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ")";
      //   array_push($categoryColor,"rgb(".$rgb[0].", ".$rgb[1].", ".$rgb[2].")");  
      //   array_push($totalDataByCategory,$allDataByCategory);
    }
    return $this->success(
      [
        'chart_data' => [
          'category' => $category,
          // 'totalData' => $totalDataByCategory,
          // 'color' => $categoryColor,
        ],
      ]
    );
    // $chartStatus = UploadForm::select('status')->groupBy('status')->get();
    // $query = UploadForm::query();
    // if ($request->faculty) {
    //   $query = $query->whereHas('users', function($query) use ($request) {
    //             $query->where('faculty', $request->faculty);
    //           });
    // }
    // if ($request->role) {
    //   $query = $query->whereHas('users', function($query) use ($request) {
    //             $query->where('role', $request->role);
    //           });
    // }
    // if ($request->category) {
    //   $query = $query->where('category', $request->category);
    // }
    // $chartAll = $query->select('date', DB::raw('count(id) as total'))->groupBy('date')->get();
    // return $this->success(
    //   [
    //     'chart_data' => [
    //                     'status' => ['Approved','Reject','Pending'],
    //                     'date' => $date,
    //                     'totalDataAll' => $totalDataAll,
    //                     'totalDataPending' => $totalDataPending,
    //                     'totalDataReject' => $totalDataReject,
    //                     'totalDataApproved' => $totalDataApproved,
    //                     ],
    //   ]
    // );
  }

  public function depositApprovedChartBarCategory(Request $request)
  {

    $totalDataByCategory = array();
    $category = Category::select('id', 'category_name')->get();

    foreach ($category as $key => $value) {
      $hash = md5('color' . $value->id);
      $rgb = array(hexdec(substr($hash, 0, 2)), hexdec(substr($hash, 2, 2)), hexdec(substr($hash, 4, 2)));
      $theCategory = strtolower($value->id);

      $allDataByCategory = UploadForm::where('category', $theCategory)
        ->where('status', 'Approved')
        ->get()
        ->count();
      $value->total = $allDataByCategory;
      $value->rgb = "rgb(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ")";
    }
    return $this->success(
      [
        'chart_data' => ['category' => $category],
      ]
    );
  }

  public function depositReportChartBarEditor(Request $request)
  {
    $begin = new DateTime("2021-09-01");
    $end = new DateTime(date("Y-m-d"));

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    $date = array();
    $totalDataAll = array();
    $totalDataPending = array();
    $totalDataReject = array();
    $totalDataApproved = array();
    foreach ($period as $dt) {
      $allDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->get()->count();
      $PendingDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->where('status', 'Pending')->get()->count();
      $ApprovedDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->where('status', 'Approved')->get()->count();
      $RejectDataByDate = UploadForm::whereDate('date', $dt->format("Y-m-d"))->where('status', 'Reject')->get()->count();
      array_push($date, $dt->format("Y-m-d"));
      array_push($totalDataAll, $allDataByDate);
      array_push($totalDataPending, $PendingDataByDate);
      array_push($totalDataApproved, $ApprovedDataByDate);
      array_push($totalDataReject, $RejectDataByDate);
    }

    // $chartStatus = UploadForm::select('status')->groupBy('status')->get();
    // $query = UploadForm::query();
    // if ($request->faculty) {
    //   $query = $query->whereHas('users', function($query) use ($request) {
    //             $query->where('faculty', $request->faculty);
    //           });
    // }
    // if ($request->role) {
    //   $query = $query->whereHas('users', function($query) use ($request) {
    //             $query->where('role', $request->role);
    //           });
    // }
    // if ($request->category) {
    //   $query = $query->where('category', $request->category);
    // }
    // $chartAll = $query->select('date', DB::raw('count(id) as total'))->groupBy('date')->get();
    return $this->success(
      [
        'chart_data' => [
          'status' => ['Approved', 'Reject', 'Pending'],
          'date' => $date,
          'totalDataAll' => $totalDataAll,
          'totalDataPending' => $totalDataPending,
          'totalDataReject' => $totalDataReject,
          'totalDataApproved' => $totalDataApproved,
        ],
      ]
    );
  }


  public function pdfReportGenerated(Request $request)
  {

    $now = date('Y-m-d');

    switch ($request->filter) {
      case 'date_range':
        $uploadForm = UploadForm::with(
          'users',
          'uploadFormCreator',
          'uploadFormSubject',
          'uploadFormContributor',
          'uploadFormDivision',
        )
          ->whereBetween('date', [$request->start_date, $request->end_date])
          ->orderBy($request->sort, $request->order)
          ->get();
        break;

      case 'this_month':
        $start = date('Y-m') . "-01";
        $a_date = date('Y-m-d');
        $end = date("Y-m-t", strtotime($a_date));

        $uploadForm = UploadForm::with(
          'users',
          'uploadFormCreator',
          'uploadFormSubject',
          'uploadFormContributor',
          'uploadFormType',
          'uploadFormDivision',
        )
          ->whereBetween('date', [$start, $end])
          ->orderBy($request->sort, $request->order)
          ->get();
        break;

      case 'category':
        $uploadForm = UploadForm::with(
          'users',
          'uploadFormCreator',
          'uploadFormSubject',
          'uploadFormContributor',
          'uploadFormType',
          'uploadFormDivision',
        )
          ->where('category', $request->category)
          ->orderBy($request->sort, $request->order)
          ->get();
        break;

      // case 'division':
      //   $uploadForm = UploadForm::with(
      //     'users',
      //     'uploadFormCreator',
      //     'uploadFormSubject',
      //     'uploadFormContributor',
      //     'uploadFormType',
      //     'uploadFormDivision',
      //   )
      //     ->whereHas('uploadFormDivision', function ($query) use ($request) {
      //       $query->where('division', $request->division);
      //     })
      //     ->with("uploadFormDivision")
      //     ->orderBy($request->sort, $request->order)
      //     ->get();
      //   break;

      default:
        $uploadForm = UploadForm::with(
          'users',
          'uploadFormCreator',
          'uploadFormSubject',
          'uploadFormContributor',
          'uploadFormType',
          'uploadFormDivision',
        )
          ->orderBy($request->sort, $request->order)
          ->get();
        break;
    }

    $json_data = [];

    foreach ($uploadForm as $key) {
      $category_name = Category::find($key->category);
      $key->category_name = $category_name->category_name;

      $language_name = Language::find($key->language);
      $key->language_name = $language_name->language_name;

      $key->status = ucfirst($key->status);

      $key->date = date('d-m-Y', strtotime($key->date));
      $key->relation = $key->relation;
      $key->right_management = $key->right_management;

      // $key->division_name = $key->uploadFormDivision[0]->division;

      $i = 0;
      $str_type = "";
      foreach ($key->uploadFormType as $ft) {
        $str_type = ($i == 0) ? $ft->type : $str_type . ',' . $ft->type;
        $i++;
      }

      $str_creator = [];
      $str_creator_ex = [];
      foreach ($key->uploadFormCreator as $ft) {
        array_push($str_creator, $ft->creator);
        array_push($str_creator_ex, [
          'name' => [
            'lineage' => null,
            'honourific' => null,
            'family' => '',
            'given' => $ft->creator
          ]
        ]);
      }
      $key->creator = $str_creator[0];

      $str_department = Department::find($key->users->department);

      $str_subject = [];
      foreach ($key->uploadFormSubject as $ft) {
        array_push($str_subject, $ft->subject);
      }
      $key->subject = $str_subject[0];
      $key->type = $key->uploadFormType[0]->type;
      $key->format = $key->uploadFormFormat[0]->format;
      // <td>Contributor test</td>
      // <td>Identifier test</td>
      // <td>Source test</td>
      // <td>Coverage test</td>
      // <td>Division Information test</td>
      $key->contributor = $key->uploadFormContributor[0]->contributor;
      $key->identifier = $key->uploadFormIdentifier[0]->identifier;
      $key->source = $key->uploadFormSource[0]->source;
      $key->coverage = $key->uploadFormCoverage[0]->coverage;
      // $key->division = $key->uploadFormDivision[0]->division;
      $key->file = $key->file;




      // ---- insert JSON data


      // $key->publisher = $str_creator[0];


      $x = [
        'id' => $key->id,
        'title' => $key->title,
        'category' => $key->getCategoryById($key->category),
        'description' => strip_tags($key->description),
        'publisher' => $key->publisher,
        'datestamp' => $key->created_at,
        'monograph_type' => $key->category_name,
        'lastmod' => $key->updated_at,
        // 'year' => $year[0],
        'date' => $key->date,
        // 'creator' => $key->creator,
        'institution' => $key->publisher,
        'ispublished' => ($key->status == "Approved") ? "Published" : $key->status,
        'type' => $str_type,
        'abstract' => strip_tags($key->description),
        'place_of_pub' => '',
        'official_url' => '',
        'corp_creators' => $str_creator,
        'patent_applicant' => '',
        'uri' => '',
        'full_text_status' => 'none',
        'department' => $str_department->department_name,
        'dir' => '',
        'userid' => $key->user_id,
        'creators' => $str_creator_ex,
        'digirepo_id' => $key->id,
        'digirepo_status' => ($key->status == "Approved") ? "Published" : $key->status,
        'metadata_visibility' => 'show',
        'subjects' => $str_subject,
        'date_type' => 'Published',
        'id_number' => $key->id,
        'rev_number' => null,
        'status_changed' => $key->updated_at,
      ];


      array_push($json_data, $x);
    }
    // CSV / Excel
    //  $year = explode("-", $key->date);
    //  $key->year = $year[0];
    //  $key->languange = $key->language;

    $data = [
      'upload_form' => $uploadForm
    ];

    // return by mode call..
    if ($request->mode == 'download_EXCEL') {
      $nama_file = 'Report_Deposit.csv';
      File::delete('downloads/release/' . $nama_file);
      $userexcel = Excel::store(new DepositExport($data), 'downloads/release/' . $nama_file, 'real_public');
      // dd($data);
      return [
        'status' => "success",
        "data" => $nama_file,
      ];
    } else if ($request->mode == 'generate_JSON') {
      $save_report = Report::create([
        'name' => $request->report_name == null ? date('Y-m-d') : $request->report_name,
        'data' => json_encode($json_data),
        'type' => 'json',
        'status' => 'success',
        'date' => date('Y-m-d H:i:s'),

      ]);
      return [
        'status' => "success",
        'success_save' => $save_report ? true : false,
        'id' => $save_report->id,
        // "data" => json_encode($uploadForm),
        "data" => json_encode($json_data),
      ];
    } else {
      $pdf = PDF::loadView('reports/generatePdfReport', $data)
        ->setPaper('a4', 'landscape')
        ->save('myfile.pdf');

      return [
        'status' => "success",
        "data" => base64_encode($pdf->output())
      ];
    }
  }

  public function getPdfReportDeposit($id)
  {

    $json = Report::find($id)->data;
    return response()->json([
      'status' => 'success',
      'data' => json_decode($json),
    ]);
    # code...
  }

  public function excelFormImport(Request $request)
  {
    try {

      Excel::import(new UploadFormImport, $request->file('file'));
      return response()->json([
        'status' => 'success',
        'message' => 'Uploaded successfully',
      ], 200);
    } catch (\Exception $exception) {
      return response()->json([
        'status' => 'error',
        'message' => $exception->getMessage()
      ], 500);
    }

    # code...
  }

  public function importSubject(Request $request)
  {
    try {

      Excel::import(new SubjectImport, $request->file('file'));
      return response()->json([
        'status' => 'success',
        'message' => 'Uploaded successfully',
      ], 200);
    } catch (\Exception $exception) {
      return response()->json([
        'status' => 'error',
        'message' => $exception->getMessage()
      ], 500);
    }
  }

  public function exportSubject()
  {
    return Excel::download(new SubjectsExport, 'subjects.xlsx');
  }
}
