<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Makanan;
use App\Services\FlaskAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the main user dashboard with calorie statistics and weekly charts.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Parse requested date or default to today
        $tanggal = $request->input('tanggal')
            ? Carbon::parse($request->input('tanggal'))->toDateString()
            : Carbon::today()->toDateString();

        // Calculate daily totals for selected date
        $kaloriMasuk = (int) Makanan::where('user_id', $userId)
            ->whereDate('waktu_konsumsi', $tanggal)
            ->sum('jumlah_kalori');

        $kaloriTerbakar = (int) Aktivitas::where('user_id', $userId)
            ->whereDate('waktu_aktivitas', $tanggal)
            ->sum('kalori_terbakar');

        $defisitKalori = $kaloriMasuk - $kaloriTerbakar;

        // Optimized 7-day chart calculation using date range queries
        $selectedDate = Carbon::parse($tanggal);
        $startDate = $selectedDate->copy()->subDays(6)->startOfDay();
        $endDate = $selectedDate->copy()->endOfDay();

        $makananDaily = Makanan::where('user_id', $userId)
            ->whereBetween('waktu_konsumsi', [$startDate, $endDate])
            ->selectRaw('DATE(waktu_konsumsi) as date, SUM(jumlah_kalori) as total')
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $aktivitasDaily = Aktivitas::where('user_id', $userId)
            ->whereBetween('waktu_aktivitas', [$startDate, $endDate])
            ->selectRaw('DATE(waktu_aktivitas) as date, SUM(kalori_terbakar) as total')
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $labels = [];
        $masuk = [];
        $terbakar = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = $selectedDate->copy()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($day)->format('d M');
            $masuk[] = (int) ($makananDaily[$day] ?? 0);
            $terbakar[] = (int) ($aktivitasDaily[$day] ?? 0);
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

    /**
     * Request AI diet advice via FlaskAiService.
     */
    public function saranAi(Request $request, FlaskAiService $aiService)
    {
        $request->validate([
            'kalori_masuk' => 'required|integer|min:0',
            'kalori_terbakar' => 'required|integer|min:0',
            'target_defisit' => 'nullable|integer',
        ]);

        $kaloriMasuk = (int) $request->input('kalori_masuk', 0);
        $kaloriTerbakar = (int) $request->input('kalori_terbakar', 0);
        $targetDefisit = (int) $request->input('target_defisit', 500);

        $saran = $aiService->getDietRecommendation($kaloriMasuk, $kaloriTerbakar, $targetDefisit);

        return redirect()->route('dashboard')->with('saran_ai', $saran);
    }
}
