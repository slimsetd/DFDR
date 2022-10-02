<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DegreeTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $degree = [
        [
          'degree_name' => "Degree 1",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'degree_name' => "Degree 2",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'degree_name' => "Degree 3",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('degree')->insert($degree);
    }
}
