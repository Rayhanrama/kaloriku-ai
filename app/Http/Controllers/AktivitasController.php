<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    // Tampilkan semua aktivitas milik user login
    public function index()
    {
        $aktivitas = Aktivitas::where('user_id', Auth::id())->get();
        return view('aktivitas.index', compact('aktivitas'));
    }

    // Tampilkan form input aktivitas
    public function create()
    {
        return view('aktivitas.create');
    }

    // Simpan data aktivitas
    public function store(Request $request)
    {
        $request->validate([
            'nama_aktivitas' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1',
            'kalori_terbakar' => 'required|integer|min:0',
            'waktu_aktivitas' => 'nullable|date',
        ]);

        Aktivitas::create([
            'nama_aktivitas' => $request->nama_aktivitas,
            'durasi' => $request->durasi,
            'kalori_terbakar' => $request->kalori_terbakar,
            'waktu_aktivitas' => $request->waktu_aktivitas,
            'user_id' => Auth::id(), // ✅ penting
        ]);

        return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil ditambahkan.');
    }
}
