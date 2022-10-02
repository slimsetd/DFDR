<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'phone',
      'email',
      'place_of_birth',
      'date_of_birth',
      'department',
      'faculty',
      'gender',
      'address',
      'years',
      'upload_card',
      'upload_card_name',
      'photo',
      'password',
      'remember_token',
      'approved',
      'role'
    ];

    public function news()
    {
      return $this->hasMany(News::class);
    }

    public function uploadForm()
    {
      return $this->hasMany(UploadForm::class);
    }

    public function notifyUser()
    {
      return $this->hasMany(notifyUser::class);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
