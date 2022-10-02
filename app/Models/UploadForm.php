<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadForm extends Model
{
    use HasFactory;
    protected $table = 'upload_form';
    protected $guarded = [];
    // protected $fillable = [
    //   'title',
    //   'category',
    //   'description',
    //   'publisher',
    //   'date',
    //   'language',
    //   'relation',
    //   'user_id',
    //   'right_management',
    //   'status',
    //   'upload_for',
    //   'total_download',
    //   'file',
    // ];

    public function users()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function uploadFormCreator()
    {
      return $this->hasMany(UploadFormCreator::class);
    }

    public function uploadFormSubject()
    {
      return $this->hasMany(UploadFormSubject::class);
    }

    public function uploadFormContributor()
    {
      return $this->hasMany(UploadFormContributor::class);
    }

    public function uploadFormType()
    {
      return $this->hasMany(UploadFormType::class);
    }

    public function uploadFormFormat()
    {
      return $this->hasMany(UploadFormFormat::class);
    }

    public function uploadFormIdentifier()
    {
      return $this->hasMany(UploadFormIdentifier::class);
    }

    public function uploadFormSource()
    {
      return $this->hasMany(UploadFormSource::class);
    }

    public function uploadFormCoverage()
    {
      return $this->hasMany(UploadFormCoverage::class);
    }

    public function uploadFormDivision()
    {
      return $this->hasMany(UploadFormDivision::class);
    }

    public function uploadFormFile()
    {
      return $this->hasMany(UploadFormFile::class);
    }

    public function notifyUpload()
    {
      return $this->hasMany(UploadFormFile::class);
    }

    public function uploadFormLanguange()
    {
      return $this->belongsTo(Language::class, 'language');
    }

    public function getCategory($name)
    {
      $category = Category::where('category_name', 'like', '%' .$name . '%')->first();
      return $category->id;
    }

    public function getCategoryById($id)
    {
      $category = Category::where('id', $id )->first();
      return $category->category_name;
    }
  

    // public function getLanguange(Type $var = null)
    // {
    //   # code...
    // }
}
