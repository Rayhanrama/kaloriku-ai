@extends('layouts.main-dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-center">Input Aktivitas</h1>

    <div class="flex justify-center">
        <form action="{{ route('aktivitas.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg w-full">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama Aktivitas</label>
                <input type="text" name="nama_aktivitas" class="w-full border border-gray-300 p-2 rounded mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Durasi (menit)</label>
                <input type="number" name="durasi" class="w-full border border-gray-300 p-2 rounded mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Kalori Terbakar</label>
                <input type="number" name="kalori_terbakar" class="w-full border border-gray-300 p-2 rounded mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Waktu Aktivitas</label>
                <input type="datetime-local" name="waktu_aktivitas" class="w-full border border-gray-300 p-2 rounded mt-1">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>
@endsection
