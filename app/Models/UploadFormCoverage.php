<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFormCoverage extends Model
{
    use HasFactory;
    protected $table = 'upload_form_coverage';
    protected $fillable = [
      'coverage',
      'upload_form_id'
    ];

    public function uploadForm()
    {
      return $this->belongsTo(UploadForm::class);
    }
}
