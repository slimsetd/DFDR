<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UploadFormTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $upload_form = [
        [
          'title' => "Judul 1",
          'category' => "Category 1",
          'creator' => "creator 1",
          'subject' => "subject 1",
          'description' => "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing 
          industries for previewing layouts and visual mockups.",
          'publisher' => "publibser 1",
          'contributor' => "contributor 1",
          'date' => new \DateTime,
          'type' => "type 1",
          'format' => "format 1",
          'identifier' => "identifier 1",
          'source' => "source 1",
          'language' => "Indonesia",
          'relation' => "lorem ipsum",
          'coverage' => "lorem ipsum",
          'division_information' => "division 1 desc",
          'file_upload' => "https://via.placeholder.com/150/24f355",
          'right_management' => "open",
          'user_id' => "1",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'title' => "Judul 2",
          'category' => "Category 2",
          'creator' => "creator 2",
          'subject' => "subject 2",
          'description' => "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing 
          industries for previewing layouts and visual mockups.",
          'publisher' => "publibser 2",
          'contributor' => "contributor 2",
          'date' => new \DateTime,
          'type' => "type 2",
          'format' => "format 2",
          'identifier' => "identifier 2",
          'source' => "source 2",
          'language' => "Indonesia",
          'relation' => "lorem ipsum",
          'coverage' => "lorem ipsum",
          'division_information' => "division 1 desc",
          'file_upload' => "https://via.placeholder.com/150/24f355",
          'right_management' => "open",
          'user_id' => "1",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('upload_form')->insert($upload_form);
    }
}
