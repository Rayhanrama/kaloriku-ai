@extends('layouts.main-dashboard')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Aktivitas</h1>
        <a href="{{ route('aktivitas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Aktivitas
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">Nama Aktivitas</th>
                    <th class="px-4 py-2">Durasi (menit)</th>
                    <th class="px-4 py-2">Kalori Terbakar</th>
                    <th class="px-4 py-2">Waktu Aktivitas</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($aktivitas as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $item->nama_aktivitas }}</td>
                        <td class="px-4 py-2">{{ $item->durasi }}</td>
                        <td class="px-4 py-2">{{ $item->kalori_terbakar }} kkal</td>
                        <td class="px-4 py-2">{{ $item->waktu_aktivitas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
