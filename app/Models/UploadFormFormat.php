<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFormFormat extends Model
{
    use HasFactory;
    protected $table = 'upload_form_format';
    protected $fillable = [
      'format',
      'upload_form_id'
    ];

    public function uploadForm()
    {
      return $this->belongsTo(UploadForm::class);
    }
}
