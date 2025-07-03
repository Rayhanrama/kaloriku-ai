    @extends('layouts.main-dashboard')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Rekomendasi AI - Kaloriku</h1>

        <p class="text-gray-600 mb-4">
            Data untuk tanggal: <strong>{{ \Carbon\Carbon::today()->format('d M Y') }}</strong>
        </p>

        <ul class="mb-4 space-y-2">
            <li>🔼 Kalori Masuk: <strong class="text-green-600">{{ $kaloriMasuk }} kkal</strong></li>
            <li>🔽 Kalori Terbakar: <strong class="text-red-600">{{ $kaloriTerbakar }} kkal</strong></li>
            <li>📉 Defisit Kalori: <strong class="text-blue-600">{{ $defisit }} kkal</strong></li>
        </ul>

        <div class="mt-6 bg-blue-50 p-4 border-l-4 border-blue-500 rounded">
            <p class="font-medium text-blue-700">💡 Rekomendasi AI:</p>
            <p class="text-gray-800 mt-1">{{ $saran }}</p>
        </div>
    </div>
@endsection
