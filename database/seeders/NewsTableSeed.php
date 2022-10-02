<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = [
            [
              'news_title' => "News Sample 1",
              'news_desc' => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.',
              'news_thumb' => "https://via.placeholder.com/150/24f355",
              'news_thumb_name' => '-',
              'created_by' => null,
              'created_at' => new \DateTime,
              'updated_at' => null,
            ],
            [
              'news_title' => "News Sample 2",
              'news_desc' => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing 
                         industries for previewing layouts and visual mockups.',
              'news_thumb' => "https://via.placeholder.com/150/24f355",
              'news_thumb_name' => '-',
              'created_by' => null,
              'created_at' => new \DateTime,
              'updated_at' => null,
            ]
        ];

        \DB::table('news')->insert($news);
    }
}
