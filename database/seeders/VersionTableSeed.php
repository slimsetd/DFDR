<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VersionTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $versions = [
            [
              'version' => "v.0.0.1",
              'version_detail' => "<h3>Digital Repository - <strong>v.0.0.1</strong></h3><hr><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
              'created_at' => new \DateTime,
            ],
            [
              'version' => "v.0.0.2",
              'version_detail' => "<h3>Digital Repository - <strong>v.0.0.2</strong></h3><hr><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
              'created_at' => new \DateTime,
            ]
        ];

        \DB::table('version')->insert($versions);
    }
}
