<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Aktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Ambil tanggal dari request (atau default hari ini)
        $tanggal = $request->input('tanggal')
            ? Carbon::parse($request->input('tanggal'))->toDateString()
            : Carbon::today()->toDateString();

        // Statistik harian
        $kaloriMasuk = Makanan::where('user_id', $userId)
            ->whereDate('waktu_konsumsi', $tanggal)
            ->sum('jumlah_kalori');

        $kaloriTerbakar = Aktivitas::where('user_id', $userId)
            ->whereDate('waktu_aktivitas', $tanggal)
            ->sum('kalori_terbakar');

        $defisitKalori = $kaloriMasuk - $kaloriTerbakar;

        // Data grafik mingguan
        $labels = [];
        $masuk = [];
        $terbakar = [];

       $selectedDate = Carbon::parse($tanggal);

        for ($i = 6; $i >= 0; $i--) {
            $day = $selectedDate->copy()->subDays($i)->toDateString();
           
            $labels[] = Carbon::parse($day)->format('d M');

            $masuk[] = Makanan::where('user_id', $userId)
                ->whereDate('waktu_konsumsi', $day)
                ->sum('jumlah_kalori');

            $terbakar[] = Aktivitas::where('user_id', $userId)
                ->whereDate('waktu_aktivitas', $day)
                ->sum('kalori_terbakar');
        }

        $grafik = [
            'labels' => $labels,
            'masuk' => $masuk,
            'terbakar' => $terbakar,
        ];

        return view('dashboard', compact(
            'kaloriMasuk',
            'kaloriTerbakar',
            'defisitKalori',
            'tanggal',
            'grafik'
        ));
    }

    public function saranAi(Request $request)
        {
              $kaloriMasuk = $request->input('kalori_masuk', 0);
                $kaloriTerbakar = $request->input('kalori_terbakar', 0);
                $targetDefisit = $request->input('target_defisit', 500);

                // Ganti dengan URL public ngrok dari Colab
                $flaskApiUrl = 'https://9683-34-168-218-235.ngrok-free.app'; // <- pastikan ini aktif

                try {
                    // Kirim POST ke endpoint /saran-ai
                    $response = Http::post($flaskApiUrl . '/saran-ai', [
                        'kalori_masuk' => $kaloriMasuk,
                        'kalori_terbakar' => $kaloriTerbakar,
                        'target_defisit' => $targetDefisit,
                    ]);

                    if ($response->successful()) {
                        $saran = $response->json()['saran'];
                        return redirect()->route('dashboard')->with('saran_ai', $saran);
                    } else {
                        return redirect()->route('dashboard')->with('saran_ai', 'Gagal mendapatkan saran dari AI.');
                    }
                } catch (\Exception $e) {
                    return redirect()->route('dashboard')->with('saran_ai', 'Terjadi error: ' . $e->getMessage());
                }

        }
}
