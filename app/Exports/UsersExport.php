<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    public function headings(): array
    {
        return ["ID","FirstName", "LastName","Email","Role"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Users::select('id','firstname','lastname','email','role')->get();
    }
}

