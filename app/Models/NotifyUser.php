<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyUser extends Model
{
    use HasFactory;
    protected $table = 'user_notify';
    protected $fillable = [
      'message',
      'user_id',
      'status',
    ];

    public function users()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
