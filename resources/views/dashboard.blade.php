@extends('layouts.main-dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-600">Selamat datang di dashboard Kaloriku.</p>
    </div>

    <!-- Filter tanggal -->
    <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex items-center gap-4">
        <label for="tanggal" class="text-gray-700 font-medium">Filter Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal"
               value="{{ request('tanggal', \Carbon\Carbon::today()->toDateString()) }}"
               class="border border-gray-300 rounded p-2" />
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Tampilkan
        </button>
    </form>

    <!-- Tombol minta saran AI -->
    <form method="GET" action="{{ route('saran.ai') }}" class="mb-6">
        <input type="hidden" name="kalori_masuk" value="{{ $kaloriMasuk }}">
        <input type="hidden" name="kalori_terbakar" value="{{ $kaloriTerbakar }}">
        <input type="hidden" name="target_defisit" value="500">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Minta Saran AI
        </button>
    </form>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-gray-700">Kalori Masuk</h2>
            <p class="text-2xl font-bold text-green-600 mt-2">{{ $kaloriMasuk }} kkal</p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-gray-700">Kalori Terbakar</h2>
            <p class="text-2xl font-bold text-red-600 mt-2">{{ $kaloriTerbakar }} kkal</p>
        </div>

        <div class="bg-white p-6 rounded shadow text-center">
            <h2 class="text-lg font-semibold text-gray-700">Defisit Kalori</h2>
            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $defisitKalori }} kkal</p>
        </div>
    </div>

    <!-- Blok Saran AI -->
   @if(session('saran_ai'))
        <div class="mb-6 bg-yellow-100 text-yellow-800 p-4 rounded shadow">
            <strong>Saran AI:</strong>
            <p>{!! nl2br(e(session('saran_ai'))) !!}</p>
        </div>
    @endif

    <!-- Grafik Mingguan -->
    <div class="mt-6 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4 text-center">Grafik Kalori Mingguan</h2>
        <canvas id="kaloriChart" height="120"></canvas>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kaloriChart').getContext('2d');
        const kaloriChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($grafik['labels']) !!},
                datasets: [
                    {
                        label: 'Kalori Masuk',
                        data: {!! json_encode($grafik['masuk']) !!},
                        backgroundColor: 'rgba(34, 197, 94, 0.7)',
                    },
                    {
                        label: 'Kalori Terbakar',
                        data: {!! json_encode($grafik['terbakar']) !!},
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
