<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendancesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Fungsi ini akan dipanggil untuk setiap baris di file Excel Anda.
        // WithHeadingRow secara otomatis mengubah header (misal: "Personnel Number") menjadi kunci (`personnel_number`)

        // Lewati baris jika nomor personal atau nama kosong
        if (empty($row['persno']) || empty($row['personnel_number'])) {
            return null;
        }

        return new Attendance([
            'personal_number' => $row['persno'],
            'name'            => $row['personnel_number'],
            'attendance_type' => $row['attendance_or_absence_type'],
            // Menggunakan fungsi khusus untuk mengubah format tanggal dari Excel dengan aman
            'start_date'      => !empty($row['start_date']) ? Date::excelToDateTimeObject($row['start_date']) : null,
            'end_date'        => !empty($row['end_date']) ? Date::excelToDateTimeObject($row['end_date']) : null,
            'days'            => $row['days'],
        ]);
    }
}
