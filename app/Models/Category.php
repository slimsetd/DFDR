<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'category';
    protected $fillable = [
      
      'category_name',
      'created_by',
      'updated_by'
    ];
}
