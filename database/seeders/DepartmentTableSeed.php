<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $department = [
        [
          'department_name' => "Department 1",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'department_name' => "Department 2",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ],
        [
          'department_name' => "Department 3",
          'created_at' => new \DateTime,
          'updated_at' => null,
        ]
      ];

      \DB::table('department')->insert($department);
    }
}
