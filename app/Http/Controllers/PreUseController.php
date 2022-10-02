<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PreUseController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = storage_path('installed');
        $exists = false;

        if(file_exists($file)){
            $exists = true;
        }
        
        return $this->success(['data' => true, 'file' => $exists]);
    }
}
