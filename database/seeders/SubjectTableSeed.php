<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $subject = [
        [
          'subject_name' => "Subject A",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'subject_name' => "Subject B",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'subject_name' => "Subject C",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('subject')->insert($subject);
    }
}
