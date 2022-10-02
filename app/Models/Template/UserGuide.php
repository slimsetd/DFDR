<?php

namespace App\Models\template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGuide extends Model
{
    use HasFactory;
    protected $table = "temp_submission_user_guide";
    protected $fillable = [
        'content'
    ];
}
