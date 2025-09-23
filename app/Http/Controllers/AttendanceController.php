<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendancesImport;
use Illuminate\Support\Facades\DB; // <-- Tambahkan ini

class AttendanceController extends Controller
{
    /**
     * Menampilkan dashboard dengan filter, pencarian, dan statistik.
     */
    public function index(Request $request)
    {
        $query = Attendance::query();

        // 1. Logika Pencarian
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('personal_number', 'like', "%{$search}%");
            });
        }

        // 2. Logika Filter
        if ($request->filled('attendance_type')) {
            $query->where('attendance_type', $request->input('attendance_type'));
        }

        // Ambil data untuk ditampilkan di tabel (dengan paginasi)
        $attendances = $query->latest()->paginate(15)->withQueryString();

        // 3. Ambil data untuk statistik
        $stats = [
            'total_records' => Attendance::count(),
            'unique_employees' => Attendance::distinct('personal_number')->count(),
            'top_attendance_type' => Attendance::select('attendance_type', DB::raw('count(*) as total'))
                                        ->groupBy('attendance_type')
                                        ->orderBy('total', 'desc')
                                        ->first(),
        ];

        // 4. Ambil semua tipe kehadiran unik untuk dropdown filter
        $attendanceTypes = Attendance::select('attendance_type')->distinct()->orderBy('attendance_type')->get();

        return view('attendances.index', compact('attendances', 'stats', 'attendanceTypes'));
    }
    
    // ... (Fungsi store, create, edit, update, destroy tetap sama)
    // ... (Pastikan fungsi-fungsi ini sudah ada di file Anda)

    /**
     * Menampilkan form untuk membuat data baru (CREATE page).
     */
    public function create()
    {
        return view('attendances.create');
    }

    /**
     * Menyimpan data baru ke database (CREATE logic).
     */
    public function store(Request $request)
    {
        $request->validate([
            'personal_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'attendance_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'days' => 'required|integer',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
                         ->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data (UPDATE page).
     */
    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    /**
     * Mengupdate data di database (UPDATE logic).
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'personal_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'attendance_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'days' => 'required|integer',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
                         ->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database (DELETE logic).
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
                         ->with('success', 'Data kehadiran berhasil dihapus.');
    }
    
    /**
     * Logika untuk import dari file Excel atau CSV.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Attendance::truncate();
            Excel::import(new AttendancesImport, $request->file('file'));
            return redirect()->route('attendances.index')->with('success', 'Data berhasil diimpor dari file Excel.');
        } catch (\Exception $e) {
            return redirect()->route('attendances.index')->with('error', 'Terjadi kesalahan saat impor: ' . $e->getMessage());
        }
    }
}

