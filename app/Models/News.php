<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
      'news_title',
      'news_desc',
      'news_thumb',
      'news_thumb_name',
      'created_by',
      'updated_by'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
