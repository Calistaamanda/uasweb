<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Pastikan Anda mengimpor kelas Request ini

use App\Models\Buku;

class KoleksiController extends Controller
{
    public function search(Request $request)
{
    // Mendapatkan input pencarian dari request
    $query = $request->input('query');

    // Melakukan pencarian berdasarkan judul atau penulis
    $bukus = Buku::where('judul', 'LIKE', "%$query%")
                ->orWhere('penulis', 'LIKE', "%$query%")
                ->get();

    // Mengirimkan hasil pencarian ke view bersama dengan query yang dicari
    return view('koleksi.koleksi', compact('bukus', 'query'));
}
}