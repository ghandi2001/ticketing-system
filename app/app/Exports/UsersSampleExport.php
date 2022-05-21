<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersSampleExport implements FromCollection
{
    public function collection()
    {
        return new Collection([
            ['name', 'surname', 'gender', 'phone number', 'personnel code'],
        ]);
    }
}
