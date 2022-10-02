<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getFile($file_name)
    {
        try {
            return response()->download(storage_path('app/private_file/' . $file_name), null, [
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ], null);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'File not found',
            ], 404);
        }
        
     
    }
  
}
