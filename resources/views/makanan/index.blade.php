@extends('layouts.main-dashboard')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Makanan</h1>
        <a href="{{ route('makanan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Makanan
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">Nama Makanan</th>
                    <th class="px-4 py-2">Jumlah Kalori</th>
                    <th class="px-4 py-2">Waktu Konsumsi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($makanans as $makanan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $makanan->nama_makanan }}</td>
                        <td class="px-4 py-2">{{ $makanan->jumlah_kalori }} kkal</td>
                        <td class="px-4 py-2">{{ $makanan->waktu_konsumsi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
