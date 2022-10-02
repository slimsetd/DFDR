<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $category = [
        [
          'category_name' => "Article",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Book",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Conference",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Patent",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Image",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Video",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Dataset",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Audio",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Teaching Resource",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Bachelor",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Thesis Master",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Dissertation",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'category_name' => "Material Review",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('category')->insert($category);
    }
}
