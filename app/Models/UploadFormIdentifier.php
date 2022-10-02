<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFormIdentifier extends Model
{
    use HasFactory;
    protected $table = 'upload_form_identifier';
    protected $fillable = [
      'identifier',
      'upload_form_id'
    ];

    public function uploadForm()
    {
      return $this->belongsTo(UploadForm::class);
    }
}
