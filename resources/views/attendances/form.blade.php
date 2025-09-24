@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="personal_number" class="block font-medium text-sm text-gray-700 dark:text-gray-300">No. Personal</label>
        <input type="text" name="personal_number" id="personal_number" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" value="{{ old('personal_number', $attendance->personal_number ?? '') }}" required>
    </div>
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama</label>
        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" value="{{ old('name', $attendance->name ?? '') }}" required>
    </div>
    <div>
        <label for="attendance_type" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tipe Kehadiran</label>
        <input type="text" name="attendance_type" id="attendance_type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" value="{{ old('attendance_type', $attendance->attendance_type ?? '') }}" required>
    </div>
    <div>
        <label for="days" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Jumlah Hari</label>
        <input type="number" name="days" id="days" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" value="{{ old('days', $attendance->days ?? '') }}" required>
    </div>
    <div>
        <label for="start_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" value="{{ old('start_date', isset($attendance->start_date) ? \Carbon\Carbon::parse($attendance->start_date)->format('Y-m-d') : '') }}" required>
    </div>
    <div>
        <label for="end_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm" value="{{ old('end_date', isset($attendance->end_date) ? \Carbon\Carbon::parse($attendance->end_date)->format('Y-m-d') : '') }}" required>
    </div>
</div>

<div class="flex items-center justify-end mt-6 space-x-3">
    <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
        Batal
    </a>
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
        {{ isset($attendance) ? 'Update Data' : 'Simpan Data' }}
    </button>
</div>