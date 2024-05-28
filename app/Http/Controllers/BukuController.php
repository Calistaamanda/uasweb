<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Notifications\NewBookNotification;
use Illuminate\Support\Facades\Notification;

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
        'judul' => 'required',
        'image' => 'required|max:1000|mimes:jpg,jpeg,png,webp',
        'penulis' => 'required',
        'genre' => 'required',
        'desc' => 'required|min:20',
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

    // Image
    $fileName = time() . '.' . $request->image->extension();
    $request->file('image')->storeAs('public/buku', $fileName);

    // Dokumen
    $dokumenExtension = $request->dokumen->extension();
    $dokumenName = Str::slug($request->judul, '-') . '_' . time() . '.' . $dokumenExtension;
    $request->file('dokumen')->storeAs('public/content-buku', $dokumenName);

    // Buku
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
            // $image = Image::make($src)->resize(1440, 720)->encode($mimetype, 100)->save(public_path($filePath));
            $new_src = asset($filePath);
            $img->removeAttribute('src');
            $img->setAttribute('src', $new_src);
            $img->setAttribute('class', 'img-responsive');
        }
    }

    Buku::create([
        'judul' => $request->judul,
        'slug' => Str::slug($request->judul, '-'),
        'image' => $fileName,
        'penulis' => $request->penulis,
        'genre' => $request->genre,
        'desc' => $dom->saveHTML(),
        'dokumen' => $dokumenName, // Menyimpan nama file PDF
    ]);

    return redirect(route('blog'))->with('success', 'Data berhasil disimpan');
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
    $buku = Buku::find($id);

    $fileCheck = $request->hasFile('image') ? 'required|max:1000|mimes:jpg,jpeg,png' : '';
    $dokumenCheck = $request->hasFile('dokumen') ? 'required|mimes:pdf|max:20000' : '';

    $rules = [
        'judul' => 'required',
        'image' => $fileCheck,
        'penulis' => 'required',
        'genre' => 'required',
        'desc' => 'required|min:20',
        'dokumen' => $dokumenCheck,
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

    // Update Image jika ada file baru
    if ($request->hasFile('image')) {
        if (\File::exists('storage/buku/' . $buku->image)) {
            \File::delete('storage/buku/' . $buku->image);
        }
        $fileName = time() . '.' . $request->image->extension();
        $request->file('image')->storeAs('public/buku', $fileName);
    } else {
        $fileName = $buku->image;
    }

    // Update Dokumen jika ada file baru
    if ($request->hasFile('dokumen')) {
        if (\File::exists('storage/content-buku/' . $buku->dokumen)) {
            \File::delete('storage/content-buku/' . $buku->dokumen);
        }
        $dokumenFileName = time() . '.' . $request->dokumen->extension();
        $request->file('dokumen')->storeAs('public/content-buku', $dokumenFileName);
    } else {
        $dokumenFileName = $buku->dokumen;
    }

    // Buku
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
            // $image = Image::make($src)->resize(1200, 1200)->encode($mimetype, 100)->save(public_path($filePath));
            $new_src = asset($filePath);
            $img->removeAttribute('src');
            $img->setAttribute('src', $new_src);
            $img->setAttribute('class', 'img-responsive');
        }
    }

    $buku->update([
        'judul' => $request->judul,
        'image' => $fileName,
        'penulis' => $request->penulis,
        'genre' => $request->genre,
        'desc' => $dom->saveHTML(),
        'dokumen' => $dokumenFileName, // Menyimpan nama file PDF
    ]);

    return redirect(route('blog'))->with('success', 'Data berhasil diupdate');
}

    // Fungsi Delete
    public function destroy($id)
    {
        $buku = Buku::find($id);
        if (\File::exists('storage/buku/' . $buku->image)) {
            \File::delete('storage/buku/' . $buku->image);
        }

        $buku->delete();

        return redirect(route('blog'))->with('success', 'data berhasil di hapus');
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
