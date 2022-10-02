<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'name',
            'phone'
        ];
    }
}