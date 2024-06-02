<?php

namespace App\Http\Controllers;

use App\Models\Buku;
// use App\Models\Notification;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Models\Berita;

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
    $rules = [
        'judul' => 'required|string|max:255',
        'isi' => 'required|string|min:10',
    ];

    $messages = [
        'judul.required' => 'Judul wajib diisi!',
        'desc.required' => 'Deskripsi wajib diisi!',
    ];

    $this->validate($request, $rules, $messages);

    // Simpan Buku
    $berita = Berita::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
    ]);

    // // Buat notifikasi baru
    // Notification::create([
    //     'title' => 'Buku Baru Ditambahkan',
    //     'message' => 'Buku "' . $berita->judul . '" telah ditambahkan oleh admin.',
    // ]);

    return redirect()->route('berita')->with('success', 'Berita berhasil ditambahkan.');
}

    // // Halaman Edit
    // public function edit($id)
    // {
    //     $buku = Buku::find($id);
    //     return view('admin.blog.edit', [
    //         'buku' => $buku
    //     ]);
    // }

    // // Fungsi Update
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'penulis' => 'required|string|max:255',
    //         'genre' => 'required|string|max:255',
    //         'desc' => 'required|string',
    //         'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:20000', // Validasi untuk dokumen
    //     ]);

        // $buku = Buku::findOrFail($id);

    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         if ($request->old_image) {
    //             Storage::delete('public/buku/' . $request->old_image);
    //         }
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->storeAs('public/buku', $imageName);
    //         $buku->image = $imageName;
    //     }

    //     // Handle dokumen upload
    //     if ($request->hasFile('dokumen')) {
    //         if ($buku->dokumen) {
    //             Storage::delete('public/buku/' . $buku->dokumen);
    //         }
    //         $dokumenName = time() . '.' . $request->dokumen->extension();
    //         $request->dokumen->storeAs('public/buku', $dokumenName);
    //         $buku->dokumen = $dokumenName;
    //     }

    //     $buku->judul = $request->judul;
    //     $buku->penulis = $request->penulis;
    //     $buku->genre = $request->genre;
    //     $buku->desc = $request->desc;
    //     $buku->save();

    //     return redirect()->route('blog')->with('success', 'Buku berhasil diperbarui.');
    // }

    // Fungsi Delete
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        
        return redirect()->route('berita')->with('success', 'Berita berhasil dihapus.');
    }

//     public function download(Buku $buku)
// {
//     if (!Auth::check()) {
//         return redirect()->route('login')->with('message', 'Silahkan login untuk mengunduh buku.');
//     }

//     $pathToFile = storage_path('app/public/content-buku/' . $buku->dokumen);

//     if (!file_exists($pathToFile)) {
//         return redirect()->route('blog')->with('error', 'File tidak ditemukan.');
//     }

//     // Mendapatkan judul buku tanpa ekstensi file
//     $judulBuku = pathinfo($buku->dokumen, PATHINFO_FILENAME);

//     // Mendapatkan ekstensi file
//     $ekstensi = pathinfo($buku->dokumen, PATHINFO_EXTENSION);

//     // Menyusun nama file yang diunduh
//     $namaFileUnduh = $judulBuku . '.' . $ekstensi;

//     return response()->download($pathToFile, $namaFileUnduh);
// }
}
