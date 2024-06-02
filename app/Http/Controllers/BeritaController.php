<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Fungsi Index
    public function index()
    {
        return view('admin.berita.index', [
            'beritas' => Berita::orderBy('id', 'desc')->get()
        ]);
    }

    // Halaman Create
    public function create()
    {
        return view('admin.berita.create');
    }

    // Fungsi Store
    public function store(Request $request)
    {
        // Validasi request
        $rules = [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string|min:15',
        ];

        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'isi.required' => 'Isi Berita wajib diisi!',
        ];

        $this->validate($request, $rules, $messages);

        // Proses isi menggunakan DOMDocument
        $dom = new \DOMDocument();
        $dom->loadHTML($request->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Simpan Berita
        $berita = Berita::create([
            'judul' => $request->judul,
            'isi' => $dom->saveHTML(),
        ]);

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Fungsi Delete
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        
        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dihapus.');
    }
}
