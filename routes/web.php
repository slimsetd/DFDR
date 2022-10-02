<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

// Route::get('/pdf-view', function () {
//     return view('pdfview');
// });

Route::get('/{slug1}', function () {
    return view('index');
});

Route::get('/{slug1}/{slug2}/{slug3}', function () {
    return view('index');
});

Route::get('/{slug1}/{slug2}', function () {
    return view('index');
});

Route::get('/{slug1}/:id', function () {
    return view('index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
