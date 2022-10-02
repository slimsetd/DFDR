<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterImage extends Model
{
    use HasFactory;
    protected $table = "temp_footer_image";
    protected $guarded = [];
}
