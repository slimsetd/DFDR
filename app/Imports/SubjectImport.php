<?php

namespace App\Imports;

use App\Models\Degree;
use App\Models\Subject;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SubjectImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // dd($row);
        $is_exist = Subject::where('subject_name', $row[0])->first();
        if ($is_exist) {
          
        }else{
            return new Subject([
                'subject_name' => $row[0],
                // 'created_by','
                // 'name'     => $row[0],
                // 'email'    => $row[1],
                // 'password' => Hash::make($row[2]),
             ]);
        }
       
    }
}
