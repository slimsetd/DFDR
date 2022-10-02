<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowSubmit extends Model
{
    use HasFactory;
    protected $table = 'temp_submission_how_to_submit';
    protected $fillable = [
        'content',
    ];
}
