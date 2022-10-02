<?php

namespace App\Models\template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'temp_slider';
    protected $fillable = [
        'content',
        'path',
        'type'
    ];
}
