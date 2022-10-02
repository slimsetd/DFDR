<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;
    protected $table = 'instruction';
    protected $fillable = [
      'instruction_name',
      'instruction_desc',
      'created_by',
      'updated_by'
    ];
}
