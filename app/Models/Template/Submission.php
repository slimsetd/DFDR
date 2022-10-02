<?php

namespace App\Models\template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $table = 'temp_submission';

    protected $fillable = [
        'content',
    ];
}
