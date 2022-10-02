<?php

namespace App\Exports;


use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubjectsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subject::select(['subject_name'])->get();
    }
}
