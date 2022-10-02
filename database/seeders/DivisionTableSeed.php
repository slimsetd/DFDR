<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisionTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $division = [
        [
          'division_name' => "Division 1",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'division_name' => "Division 2",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'division_name' => "Division 3",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('division')->insert($division);
    }
}
