@extends('layouts.main')

@section('content')
    <div class="bg-white py-16 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl font-extrabold text-blue-600 sm:text-5xl">Selamat Datang di Kaloriku</h1>
            <p class="mt-6 text-lg text-gray-600">
                Kaloriku adalah platform untuk membantumu mencatat asupan kalori harian, memantau aktivitas, dan mengelola defisit kalori untuk hidup lebih sehat.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mulai Sekarang</a>
                <a href="#kontak" class="px-6 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50">Kontak Kami</a>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 py-12">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-blue-600">Pantau Kalori Masuk</h2>
                <p class="mt-2 text-gray-600">Catat makanan harianmu dan pantau jumlah kalori yang dikonsumsi.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-blue-600">Hitung Kalori Terbakar</h2>
                <p class="mt-2 text-gray-600">Masukkan aktivitas olahraga untuk melihat defisit kalori.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-blue-600">AI Rekomendasi</h2>
                <p class="mt-2 text-gray-600">Dapatkan saran makanan rendah kalori dari IBM Watson (segera hadir).</p>
            </div>
        </div>
    </div>

    <div id="kontak" class="bg-white py-12 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-blue-600">Hubungi Kami</h2>
            <p class="mt-4 text-gray-600">Punya pertanyaan atau saran? Kami ingin mendengarnya!</p>
            <p class="mt-2 text-gray-500">Email: support@kaloriku.id | Instagram: @kaloriku.id</p>
        </div>
    </div>
@endsection
