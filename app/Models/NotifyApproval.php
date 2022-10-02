<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyApproval extends Model
{
    use HasFactory;
    protected $table = 'approval_notify';
    protected $fillable = [
      'message',
      'status',
      'deposit_id',
      'user_id'
    ];

    public function uploadForm()
    {
      return $this->belongsTo(UploadForm::class);
    }
}
