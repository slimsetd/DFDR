<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DegreeController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\InstructionController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\UploadFormController;
use App\Http\Controllers\Api\YearController;

use App\Http\Controllers\Api\ReportController;

use App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\NotificationController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PreUseController;
use App\Http\Controllers\Template\AboutUsController;
use App\Http\Controllers\Template\ContactController;
use App\Http\Controllers\Template\ContentGuidelaneController;
use App\Http\Controllers\Template\HomeController;
use App\Http\Controllers\Template\HowSubmitController;
use App\Http\Controllers\Template\LicenseController;
use App\Models\Template\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/test', function () {
//     return "test";
// });

// Public routes


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

 

  Route::get('/user/export-user-excel', [UserController::class, 'export']);
  Route::get('/user/export-editor-excel', [UserController::class, 'exportEditor']);
  Route::get('/user/export-template-excel', [UserController::class, 'exportTemplate']);
  Route::get('/get-notification', [NotificationController::class, 'sendOfferNotification']);
  
  // category 
  Route::post('/category', [CategoryController::class, 'store']);
  Route::put('/category/{id}', [CategoryController::class, 'update']);
  Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

  // Degree 
  Route::post('/degree', [DegreeController::class, 'store']);
  Route::put('/degree/{id}', [DegreeController::class, 'update']);
  Route::delete('/degree/{id}', [DegreeController::class, 'destroy']);

  // Department 
  Route::post('/department', [DepartmentController::class, 'store']);
  Route::put('/department/{id}', [DepartmentController::class, 'update']);
  Route::delete('/department/{id}', [DepartmentController::class, 'destroy']);

  // Division 
  Route::post('/division', [DivisionController::class, 'store']);
  Route::put('/division/{id}', [DivisionController::class, 'update']);
  Route::delete('/division/{id}', [DivisionController::class, 'destroy']);

  // Faculty 
  Route::post('/faculty', [FacultyController::class, 'store']);
  Route::put('/faculty/{id}', [FacultyController::class, 'update']);
  Route::delete('/faculty/{id}', [FacultyController::class, 'destroy']);

  // Instruction 
  Route::post('/instruction', [InstructionController::class, 'store']);
  Route::put('/instruction/{id}', [InstructionController::class, 'update']);
  Route::delete('/instruction/{id}', [InstructionController::class, 'destroy']);

  // Language 
  Route::post('/language', [LanguageController::class, 'store']);
  Route::put('/language/{id}', [LanguageController::class, 'update']);
  Route::delete('/language/{id}', [LanguageController::class, 'destroy']);

  // News 
  Route::post('/news', [NewsController::class, 'store']);
  Route::put('/news/{id}', [NewsController::class, 'update']);
  Route::delete('/news/{id}', [NewsController::class, 'destroy']);

  // Subject 
  Route::post('/subject', [SubjectController::class, 'store']);
  Route::put('/subject/{id}', [SubjectController::class, 'update']);
  Route::delete('/subject/{id}', [SubjectController::class, 'destroy']);

  // year 
  Route::post('/year', [YearController::class, 'store']);
  Route::put('/year/{id}', [YearController::class, 'update']);
  Route::delete('/year/{id}', [YearController::class, 'destroy']);

  // uploadForm --
  Route::get('/upload-form/user', [UploadFormController::class, 'showByUser']);
  Route::post('/upload-form/user/{id}', [UploadFormController::class, 'showById']);
  Route::post('/upload-form', [UploadFormController::class, 'store']);
  Route::put('/upload-form/approval/{id}', [UploadFormController::class, 'update']);
  Route::post('/upload-form/data/{id}', [UploadFormController::class, 'updateData']);
  Route::get('/upload-form/month', [UploadFormController::class, 'showByThisMonth']);

  Route::post('/upload-form/checkTitle', [UploadFormController::class, 'checkTitle']);
  Route::delete('/upload-form/{id}', [UploadFormController::class, 'destroy']);
  Route::delete('/upload-form-file/{id}', [UploadFormController::class, 'destroyFile']);
  Route::post('/upload-form-file', [UploadFormController::class, 'storeFile']);
  Route::post('/upload-form-file/update', [UploadFormController::class, 'updateFile']);
  Route::post('/upload-form/increments/{id}', [UploadFormController::class, 'downloadIncrement']);

  // User management
  // Route::get('/user', [UserController::class, 'index']);
  Route::get('/user/contribution', [UserController::class, 'userDepositCont']);
  Route::get('/user/editor', [UserController::class, 'userEditor']);
  Route::get('/user/main', [UserController::class, 'userMain']);
  Route::get('/user/{id}', [UserController::class, 'show']);
  Route::put('/user/verified/{id}', [UserController::class, 'update']);
  Route::delete('/user/{id}', [UserController::class, 'destroy']);
  Route::post('/user/updateData/{id}', [UserController::class, 'updateData']);
  Route::post('/user/updateDataFull/{id}', [UserController::class, 'updateDataFull']);
  

  Route::post('/user/checkName', [UserController::class, 'checkName']);
  Route::post('/user/checkEmail', [UserController::class, 'checkEmail']);
  Route::post('/user/checkSpecific', [UserController::class, 'checkSpecific']);
  Route::post('/user/checkPass/{id}', [UserController::class, 'checkPass']);
  Route::post('/user/changePass/{id}', [UserController::class, 'changePass']);

  //chart
  Route::post('/list/report/deposit/chart/bar', [ReportController::class, 'depositReportChartBar']);
  Route::get('/list/report/deposit/chart/bar/faculty', [ReportController::class, 'depositReportChartFaculty']);
  Route::get('/list/report/deposit/chart/bar/year', [ReportController::class, 'depositReportChartYear']);
  Route::get('/list/report/deposit/chart/bar/category', [ReportController::class, 'depositReportChartBarCategory']);
  Route::get('/list/approved/deposit/chart/bar/category', [ReportController::class, 'depositApprovedChartBarCategory']);
  Route::get('/list/report/deposit/chart/bar/editor', [ReportController::class, 'depositReportChartEditorContribution']);

  // Report 
  Route::get('/list/data/dashboard/creator', [ReportController::class, 'showCreator']);
  Route::get('/list/data/dashboard/editor', [ReportController::class, 'ShowEditor']);
  Route::get('/list/data/version', [ReportController::class, 'ShowVersion']);
  Route::get('/list/data/dashboard/division', [ReportController::class, 'ShowDivision']);
  Route::get('/list/count/dashboard', [ReportController::class, 'index']);
  Route::post('/list/report/deposit/filter', [ReportController::class, 'depositReportFilter']);
  Route::post('/list/report/deposit/chart', [ReportController::class, 'depositReportChart']);

  Route::get('/database/export', [ReportController::class, 'ExportDB']);

  // Route::get('/list/count/user/dashboard', [ReportController::class, 'indexforuser']);

  Route::post('/user/import', [UserController::class, 'import']);
  Route::post('/user/importEditor', [UserController::class, 'importEditor']);
  // Route::get('/user/export', [UserController::class, 'export']);
  // Route::get('/user/export-excel', [UserController::class, 'exportExcel']);


  // Auth
  Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/user', [UserController::class, 'index']);
Route::post('/user/checkName', [UserController::class, 'checkName']);
Route::post('/user/checkEmail', [UserController::class, 'checkEmail']);
Route::post('/user/checkSpecific', [UserController::class, 'checkSpecific']);
Route::post('/user/reqResetPass', [UserController::class, 'reqResetPass']);
Route::post('/user/checkCode', [UserController::class, 'checkCode']);
Route::post('/user/resetPass', [UserController::class, 'resetPass']);

Route::get('/vpdf', [UserController::class, 'viewPDF']);

Route::get('/show-image/{imagePath}/{fileName}', [ImageController::class, 'showUploadCard']);

Route::get('/list/data/type', [ReportController::class, 'showType']);
Route::get('/list/data/subject', [ReportController::class, 'showSubject']);

Route::get('/preUsed', [PreUseController::class, 'index']);

Route::get('/preAdmin', [AuthController::class, 'preAdmin']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/registerAdmin', [AuthController::class, 'registerAdmin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

Route::post('/email/reset-password', [AuthController::class, 'reset']);

Route::get('/creators', [ReportController::class, 'showCreator']);

// Cateegory
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/category/search/{name}', [CategoryController::class, 'search']);

// Degree
Route::get('/degree', [DegreeController::class, 'index']);
Route::get('/degree/{id}', [DegreeController::class, 'show']);
Route::get('/degree/search/{name}', [DegreeController::class, 'search']);

// Department
Route::get('/department', [DepartmentController::class, 'index']);
Route::get('/department/{id}', [DepartmentController::class, 'show']);
Route::get('/department/search/{name}', [DepartmentController::class, 'search']);

// Division
Route::get('/division', [DivisionController::class, 'index']);
Route::get('/division/{id}', [DivisionController::class, 'show']);
Route::get('/division/search/{name}', [DivisionController::class, 'search']);

// Faculty
Route::get('/faculty', [FacultyController::class, 'index']);
Route::get('/faculty/{id}', [FacultyController::class, 'show']);
Route::get('/faculty/search/{name}', [FacultyController::class, 'search']);

// Instruction
// Route::get('/instruction', [InstructionController::class, 'index']);
// Route::get('/instruction/{id}', [InstructionController::class, 'show']);
// Route::get('/instruction/search/{name}', [InstructionController::class, 'search']);

// Language
Route::get('/language', [LanguageController::class, 'index']);
Route::get('/language/{id}', [LanguageController::class, 'show']);
Route::get('/language/search/{name}', [LanguageController::class, 'search']);

// News
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::get('/news/search/{name}', [NewsController::class, 'search']);

// Subject
Route::get('/subject', [SubjectController::class, 'index']);
Route::get('/subject/{id}', [SubjectController::class, 'show']);
Route::get('/subject/search/{name}', [SubjectController::class, 'search']);

// Year
Route::get('/year', [YearController::class, 'index']);
Route::get('/year/{id}', [YearController::class, 'show']);
Route::get('/year/search/{name}', [YearController::class, 'search']);

// UploadForm

Route::post('/upload-form/search/new/title', [UploadFormController::class, 'newSearchGlobalTitle']);
Route::get('/upload-form/search/new/global/{search}', [UploadFormController::class, 'newSearchGlobal']);
Route::post('/upload-form/search/new/filter', [UploadFormController::class, 'newSearchPerHit']);

Route::get('/upload-form/{id}', [UploadFormController::class, 'show']);
Route::post('/upload-form/increments/{id}', [UploadFormController::class, 'downloadIncrement']);
Route::get('/upload-form/{sort?}', [UploadFormController::class, 'index']);
Route::get('/upload-form/json-generated', [UploadFormController::class, 'jsonGenerated']);
// Route::get('/upload-form/testjson', [UploadFormController::class, 'testjson']);

Route::get('/upload-form/search/year/{year}/{sort?}', [UploadFormController::class, 'searchByYear']);
// Route::get('/upload-form/search/title/{title}/{sort?}', [UploadFormController::class, 'searchByTitle']);
Route::get('/upload-form/search/creator/{creator}/{sort?}', [UploadFormController::class, 'searchByCreator']);
Route::get('/upload-form/search/category/{category}/{sort?}', [UploadFormController::class, 'searchByCategory']);
Route::get('/upload-form/search/status/{status}/{sort?}', [UploadFormController::class, 'searchByStatus']);
Route::get('/upload-form/search/global/{search}/{sort?}', [UploadFormController::class, 'searchGlobal']);

Route::get('/group/count/deposit', [ReportController::class, 'countGroupCategory']);

Route::get('/get-notification-user', [NotificationController::class, 'userNew']);
Route::get('/read-notification-user/{id}', [NotificationController::class, 'userNewRead']);

Route::get('/get-notification-upload', [NotificationController::class, 'uploadNew']);
Route::get('/read-notification-upload/{id}', [NotificationController::class, 'uploadNewRead']);


Route::get('/get-notification-approval/{userId}', [NotificationController::class, 'ApprovalNew']);
Route::get('/read-notification-approval/{id}', [NotificationController::class, 'ApprovalNewRead']);


Route::post('/pdf/generated/report/', [ReportController::class, 'pdfReportGenerated']);
Route::post('/excel/import/report/', [ReportController::class, 'excelFormImport']);
Route::post('/excel/import/subject', [ReportController::class, 'importSubject']);
Route::get('/excel/export/subject', [ReportController::class, 'exportSubject']);
Route::post('/excel/deposit/report/', [ReportController::class, 'excelReportDeposit']);
// mw get report
Route::get('/pdf/deposit/{id}/report/', [ReportController::class, 'getPdfReportDeposit']);
 // get file
 Route::get('/file/{file_name}', [FileController::class, 'getFile']);


 // Admin template

 Route::prefix('template')->group(function () {
     
    route::apiResource('/about-us', AboutUsController::class);
    route::apiResource('/contact', ContactController::class);
    route::apiResource('/content-guidelane', ContentGuidelaneController::class);
    route::apiResource('/home', HomeController::class);
    route::get('submission', [HomeController::class, 'getSubmissionDescription']);
    route::get('/get-path', [HomeController::class, 'getPath']);
    route::get('/get-private-path', [HomeController::class, 'getPrivatePath']);
    route::put('submission/{id}', [HomeController::class, 'updateSubmissionDescription']);
    route::get('images', [HomeController::class, 'getImages']);
    route::get('footer-image', [HomeController::class, 'getFooterImages']);
    route::get('footer-image/{id}', [HomeController::class, 'showFooterImages']);
    route::post('images', [HomeController::class, 'storeImages']);
    route::post('footer-images', [HomeController::class, 'storeFooterImages']);
    route::post('image/update', [HomeController::class, 'updateImages']);
    route::post('footer-images/update', [HomeController::class, 'updateFooterImages']);
    route::get('image/{id}', [HomeController::class, 'showImages']);
    route::delete('image/{id}', [HomeController::class, 'deleteImage']);
    route::delete('footer-images/{id}', [HomeController::class, 'deleteFooterImage']);

    route::apiResource('/license', LicenseController::class);
    route::get('user-guide', [LicenseController::class, 'getUserGuide']);
    route::put('user-guide/{id}', [LicenseController::class, 'updateUserGuide']);
    route::apiResource('/how-submit', HowSubmitController::class);
 });




// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
