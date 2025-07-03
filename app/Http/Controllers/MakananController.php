<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MakananController extends Controller
{
    // Menampilkan semua makanan milik user login
    public function index()
    {
        $makanans = Makanan::where('user_id', Auth::id())->get();
        return view('makanan.index', compact('makanans'));
    }

    // Menampilkan form input makanan
    public function create()
    {
        return view('makanan.create');
    }

    // Menyimpan data makanan
    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'jumlah_kalori' => 'required|integer|min:0',
            'waktu_konsumsi' => 'nullable|date',
        ]);

        Makanan::create([
            'nama_makanan' => $request->nama_makanan,
            'jumlah_kalori' => $request->jumlah_kalori,
            'waktu_konsumsi' => $request->waktu_konsumsi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil ditambahkan.');
    }

    // (Opsional) Menampilkan detail makanan
    public function show(Makanan $makanan)
    {
        //
    }

    // Menampilkan form edit makanan
    public function edit(Makanan $makanan)
    {
        // Cek apakah makanan milik user login
        if ($makanan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('makanan.edit', compact('makanan'));
    }

    // Menyimpan perubahan
    public function update(Request $request, Makanan $makanan)
    {
        if ($makanan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'jumlah_kalori' => 'required|integer|min:0',
            'waktu_konsumsi' => 'nullable|date',
        ]);

        $makanan->update([
            'nama_makanan' => $request->nama_makanan,
            'jumlah_kalori' => $request->jumlah_kalori,
            'waktu_konsumsi' => $request->waktu_konsumsi,
        ]);

        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil diperbarui.');
    }

    // Menghapus makanan
    public function destroy(Makanan $makanan)
    {
        if ($makanan->user_id !== Auth::id()) {
            abort(403);
        }

        $makanan->delete();

        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil dihapus.');
    }
}
