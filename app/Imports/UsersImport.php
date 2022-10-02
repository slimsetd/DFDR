<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Year;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {

    // dd($row);
    $user_exist = User::find($row['id']);
    if ($user_exist) {
      $user_exist->update([
        'name' => $row['full_name'],
        'phone' => $row['phone_number'],
        'email' => $row['email_address'],
        'place_of_birth' => $row['place_of_birth'],
        'date_of_birth' => $row['date_of_birth'],
        'department' => $this->getData('department',$row['department']),
        'faculty' => $this->getData('faculty',$row['faculty']),
        'gender' => $row['gender'],
        'address' => $row['address'],
        'years' => $this->getData('years',$row['year']),
        'upload_card' => "http://127.0.0.1:8000/show-image/upload_card/id_card_placeholder.png",
        'upload_card_name' => "id_card_placeholder.png",
        'photo' => "-",
        // 'password' => \Hash::make('defaultpassword'),
        'approved' => $row['approved'] == 'Yes' ? 1 : 0,
        'role' => $row['role'],

      ]);
    } else {
      User::create([
        'name' => $row['full_name'],
        'phone' => $row['phone_number'],
        'email' => $row['email_address'],
        'place_of_birth' => $row['place_of_birth'],
        'date_of_birth' => $row['date_of_birth'],
        'department' => $this->getData('department',$row['department']),
        'faculty' => $this->getData('faculty',$row['faculty']),
        'gender' => $row['gender'],
        'address' => $row['address'],
        'years' => $this->getData('years',$row['year']),
        'upload_card' => "http://127.0.0.1:8000/show-image/upload_card/id_card_placeholder.png",
        'upload_card_name' => "id_card_placeholder.png",
        'photo' => "-",
        'password' => Hash::make('password123'),
        'approved' => $row['approved'] == 'Yes' ? 1 : 0,
        'role' => $row['role'],
      ]);
    }
  }

  public function getData($att, $name)
  {
    
    $id = null;
    switch ($att) {
        // department, faculty, years
      case 'department':
        $id = Department::where('department_name', 'like', '%' . $name . '%')->first()->id;
        # code...
        break;
      case 'faculty':
        $id = Faculty::where('faculty_name', 'like', '%' . $name . '%')->first()->id;

        break;
      case 'years':
        $id = Year::where('year', 'like', '%' . $name . '%')->first()->id;

        break;

      default:
        # code...
        break;
    }
    return $id;
  }
}
