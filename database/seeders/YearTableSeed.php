<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class YearTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $years = [
        [
          'year' => "2015",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'year' => "2016",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'year' => "2017",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'year' => "2018",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'year' => "2019",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'year' => "2020",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'year' => "2021",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('years')->insert($years);
    }
}
