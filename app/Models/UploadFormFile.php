<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFormFile extends Model
{
    use HasFactory;
    protected $table = 'upload_form_file';
    protected $fillable = [
      'file',
      'file_name',
      'file_size',
      'file_extention',
      'upload_form_id',
      'is_private'
    ];

    public function uploadForm()
    {
      return $this->belongsTo(UploadForm::class);
    }
}
