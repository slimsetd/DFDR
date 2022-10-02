<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    use ApiResponser;
    public function showUploadCard($imagePath, $fileName)
    {
      $path = public_path('storage/uploads/'.$imagePath. '/' . $fileName);
      // dd($path);
      if (!File::exists($path)) {
          return $this->error("image not found", 404);
      }

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }
}
