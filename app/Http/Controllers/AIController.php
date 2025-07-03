<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Makanan;
use App\Models\Aktivitas;
use Illuminate\Support\Carbon;

class AIController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $tanggal = Carbon::today()->toDateString();

        $kaloriMasuk = Makanan::where('user_id', $userId)
            ->whereDate('waktu_konsumsi', $tanggal)
            ->sum('jumlah_kalori');

        $kaloriTerbakar = Aktivitas::where('user_id', $userId)
            ->whereDate('waktu_aktivitas', $tanggal)
            ->sum('kalori_terbakar');

        $defisit = $kaloriMasuk - $kaloriTerbakar;

        // Simulasi respons AI
        if ($defisit > 0) {
            $saran = "Hari ini kamu mengalami surplus kalori sebesar {$defisit}kkal. Coba lakukan aktivitas ringan seperti jalan kaki selama 30 menit.";
        } elseif ($defisit < 0) {
            $saran = "Bagus! Kamu mengalami defisit kalori sebesar " . abs($defisit) . "kkal. Pertahankan agar tidak terlalu ekstrem.";
        } else {
            $saran = "Kalorimu hari ini seimbang. Jaga pola makan dan aktivitas secara konsisten.";
        }

        return view('ai.index', compact('kaloriMasuk', 'kaloriTerbakar', 'defisit', 'saran'));
    }
}
