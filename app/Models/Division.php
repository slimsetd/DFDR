<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $table = 'division';
    protected $fillable = [
      'division_name',
      'created_by',
      'updated_by'
    ];
}
