<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // for ($i=0; $i < 25 ; $i++) { 
        $users = 
        [
          [
              'name'=> "Admin",
              'phone'=> "081100001234",
              'email'=> "admin@mail.com" . $i ,
              'place_of_birth'=> "Bogor",
              'date_of_birth'=> "1999-01-01",
              'department'=> "0",
              'faculty'=> "0",
              'gender'=> "L",
              'address'=> "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing 
              industries for previewing layouts and visual mockups.",
              'years'=> "1",
              'upload_card'=> "http://127.0.0.1:8000/show-image/upload_card/id_card_placeholder.png",
              'photo' => "-",
              'role' => "Admin",
              'upload_card_name' => "id_card_placeholder.png",
              'password' => bcrypt('digirepo'),
              'approved' => "1",
              'created_at' => new \DateTime,
              'updated_at' => null,
          ],
        ];
  
        \DB::table('users')->insert($users);
      // }
    }
}
