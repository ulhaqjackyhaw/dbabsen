<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendancesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Attendance([
            'personal_number' => $row['persno'],
            'name'            => $row['personnel_number'],
            'attendance_type' => $row['attendance_or_absence_type'],
            'days'            => $row['days'] ?? 0, // Disesuaikan dengan header 'Days' di file CSV
            'start_date'      => !empty($row['start_date']) ? Date::excelToDateTimeObject($row['start_date']) : null,
            'end_date'        => !empty($row['end_date']) ? Date::excelToDateTimeObject($row['end_date']) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'persno' => 'required',
            'personnel_number' => 'required',
            'attendance_or_absence_type' => 'required',
        ];
    }
}