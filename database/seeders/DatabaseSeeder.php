<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        // UserTableSeed::class,
        CategoryTableSeed::class,
        DegreeTableSeed::class,
        DepartmentTableSeed::class,
        DivisionTableSeed::class,
        FacultyTableSeed::class,
        LanguageTableSeed::class,
        NewsTableSeed::class,
        SubjectTableSeed::class,
        YearTableSeed::class,
        VersionTableSeed::class,
        // UploadFormTableSeed::class,
      ]);
    }
}
