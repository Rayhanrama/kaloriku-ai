@extends('layouts.main-dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-center">Input Makanan</h1>

    <div class="flex justify-center">
        <form action="{{ route('makanan.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg w-full">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama Makanan</label>
                <input type="text" name="nama_makanan" class="w-full border border-gray-300 p-2 rounded mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jumlah Kalori</label>
                <input type="number" name="jumlah_kalori" class="w-full border border-gray-300 p-2 rounded mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Waktu Konsumsi</label>
                <input type="datetime-local" name="waktu_konsumsi" class="w-full border border-gray-300 p-2 rounded mt-1">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>
@endsection
