<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacultyTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faculty = [
        [
          'faculty_name' => "Faculty A",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'faculty_name' => "Faculty B",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'faculty_name' => "Faculty C",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('faculty')->insert($faculty);
    }
}
