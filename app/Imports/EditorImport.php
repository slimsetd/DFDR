<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EditorImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      // dd($row[0]);
        return new User([
          'name' => $row['name'],
          'phone' => $row['phone'],
          'email' => $row['email'],
          'place_of_birth' => $row['place_of_birth'],
          'date_of_birth' => $row['date_of_birth'],
          'department' => "0",
          'faculty' => "0",
          'gender' => $row['gender'],
          'address' => $row['address'],
          'years' => "0",
          'upload_card' => "http://127.0.0.1:8000/show-image/upload_card/id_card_placeholder.png",
          'upload_card_name' => "id_card_placeholder.png",
          'photo' => "-",
          'password' => \Hash::make('defaultpassword'),
          'approved' => $row['approved'],
          'role' => "Editor",
        ]);
    }
}
