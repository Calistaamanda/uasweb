<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Notification;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\User;


class BukuController extends Controller
{
    // Fungsi Index
    public function index()
    {
        return view('admin.blog.index', [
            'bukus' => Buku::orderBy('id', 'desc')->get()
        ]);
    }

    // Halaman Create
    public function create()
    {
        return view('admin.blog.create');
    }

    // Fungsi Store
    public function store(Request $request)
{
    $rules = [
        'judul' => 'required|string|max:255',
        'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,webp',
        'penulis' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'desc' => 'required|string|min:20',
        'dokumen' => 'required|mimes:pdf|max:20000', // Validasi PDF
    ];

    $messages = [
        'judul.required' => 'Judul wajib diisi!',
        'image.required' => 'Image wajib diisi!',
        'penulis.required' => 'Penulis wajib diisi!',
        'genre.required' => 'Genre wajib diisi!',
        'desc.required' => 'Deskripsi wajib diisi!',
        'dokumen.required' => 'Dokumen wajib diisi!',
        'dokumen.mimes' => 'Dokumen harus berupa file PDF!',
    ];

    $this->validate($request, $rules, $messages);

    // Proses Image
    $fileName = time() . '.' . $request->image->extension();
    $request->file('image')->storeAs('public/buku', $fileName);

    // Proses Dokumen
    $dokumenExtension = $request->dokumen->extension();
    $dokumenName = Str::slug($request->judul, '-') . '_' . time() . '.' . $dokumenExtension;
    $request->file('dokumen')->storeAs('public/content-buku', $dokumenName);

    // Proses Deskripsi (dengan gambar)
    $storage = "storage/content-buku";
    $dom = new \DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
    libxml_clear_errors();

    $images = $dom->getElementsByTagName('img');

    foreach ($images as $img) {
        $src = $img->getAttribute('src');
        if (preg_match('/data:image/', $src)) {
            preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
            $mimetype = $groups['mime'];
            $fileNameContent = uniqid();
            $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
            $filePath = ("$storage/$fileNameContentRand.$mimetype");
            $new_src = asset($filePath);
            $img->removeAttribute('src');
            $img->setAttribute('src', $new_src);
            $img->setAttribute('class', 'img-responsive');
        }
    }

    // Simpan Buku
    $buku = Buku::create([
        'judul' => $request->judul,
        'slug' => Str::slug($request->judul, '-'),
        'image' => $fileName,
        'penulis' => $request->penulis,
        'genre' => $request->genre,
        'desc' => $dom->saveHTML(),
        'dokumen' => $dokumenName, // Menyimpan nama file PDF
    ]);

    // Buat notifikasi baru
    Notification::create([
        'title' => 'Buku Baru Ditambahkan',
        'message' => 'Buku "' . $buku->judul . '" telah ditambahkan oleh admin.',
    ]);

    return redirect()->route('blog')->with('success', 'Buku berhasil ditambahkan.');
}



    // Halaman Edit
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('admin.blog.edit', [
            'buku' => $buku
        ]);
    }

    // Fungsi Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'penulis' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'desc' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:20000', // Validasi untuk dokumen
        ]);

        $buku = Buku::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($request->old_image) {
                Storage::delete('public/buku/' . $request->old_image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/buku', $imageName);
            $buku->image = $imageName;
        }

        // Handle dokumen upload
        if ($request->hasFile('dokumen')) {
            if ($buku->dokumen) {
                Storage::delete('public/buku/' . $buku->dokumen);
            }
            $dokumenName = time() . '.' . $request->dokumen->extension();
            $request->dokumen->storeAs('public/buku', $dokumenName);
            $buku->dokumen = $dokumenName;
        }

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->genre = $request->genre;
        $buku->desc = $request->desc;
        $buku->save();

        return redirect()->route('blog')->with('success', 'Buku berhasil diperbarui.');
    }

    // Fungsi Delete
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        
        return redirect()->route('blog')->with('success', 'Buku berhasil dihapus.');
    }

    public function download(Buku $buku)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'Silahkan login untuk mengunduh buku.');
    }

    $pathToFile = storage_path('app/public/content-buku/' . $buku->dokumen);

    if (!file_exists($pathToFile)) {
        return redirect()->route('blog')->with('error', 'File tidak ditemukan.');
    }

    // Mendapatkan judul buku tanpa ekstensi file
    $judulBuku = pathinfo($buku->dokumen, PATHINFO_FILENAME);

    // Mendapatkan ekstensi file
    $ekstensi = pathinfo($buku->dokumen, PATHINFO_EXTENSION);

    // Menyusun nama file yang diunduh
    $namaFileUnduh = $judulBuku . '.' . $ekstensi;

    return response()->download($pathToFile, $namaFileUnduh);
}
}
