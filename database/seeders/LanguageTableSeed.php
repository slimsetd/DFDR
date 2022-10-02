<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $language = [
        [
          'language_name' => "Indonesia",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'language_name' => "English",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'language_name' => "Italy",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('language')->insert($language);
    }
}
