<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyUpload extends Model
{
    use HasFactory;
    protected $table = 'upload_notify';
    protected $fillable = [
      'message',
      'upload_form_id',
      'status',
    ];

    public function uploadForm()
    {
      return $this->belongsTo(UploadForm::class);
    }
}
