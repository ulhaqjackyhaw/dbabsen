@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="personal_number" class="block font-medium text-sm text-gray-700">No. Personal</label>
        <input type="text" name="personal_number" id="personal_number" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('personal_number', $attendance->personal_number ?? '') }}" required>
    </div>
    <div>
        <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
        <input type="text" name="name" id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('name', $attendance->name ?? '') }}" required>
    </div>
    <div>
        <label for="attendance_type" class="block font-medium text-sm text-gray-700">Tipe Kehadiran</label>
        <input type="text" name="attendance_type" id="attendance_type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('attendance_type', $attendance->attendance_type ?? '') }}" required>
    </div>
    <div>
        <label for="days" class="block font-medium text-sm text-gray-700">Jumlah Hari</label>
        <input type="number" name="days" id="days" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('days', $attendance->days ?? '') }}" required>
    </div>
    <div>
        <label for="start_date" class="block font-medium text-sm text-gray-700">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('start_date', $attendance->start_date ?? '') }}" required>
    </div>
    <div>
        <label for="end_date" class="block font-medium text-sm text-gray-700">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('end_date', $attendance->end_date ?? '') }}" required>
    </div>
</div>

<div class="flex items-center justify-end mt-4">
    <a href="{{ route('attendances.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        Simpan
    </button>
</div>