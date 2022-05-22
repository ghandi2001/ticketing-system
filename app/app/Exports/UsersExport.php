<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::query()->select(['id','name','surname','gender','phone_number','personnel_code','has_accessed','created_at','updated_at','deleted_at'])->get();
    }

    public function headings(): array
    {
        return array_merge(['id'],array_diff((new User)->getFillable(),['password','phone_number_verified_at','profile_picture']),['created_at','updated_at','deleted_at']);
    }
}
