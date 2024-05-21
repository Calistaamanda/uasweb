<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;

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
            'dokumen' => 'mimes:pdf',
        ];

        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'image.required' => 'Image wajib diisi!',
            'penulis.required' => 'Penulis wajib diisi!',
            'genre.required' => 'Genre wajib diisi!',
            'desc.required' => 'Deskripsi wajib diisi!',
        ];

        $this->validate($request, $rules, $messages);

        // Image
        $fileName = time() . '.' . $request->image->extension();
        $request->file('image')->storeAs('public/buku', $fileName);

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
            'dokumen' => $fileName,
        ]);

        return redirect(route('blog'))->with('success', 'data berhasil di simpan');
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

        # Jika ada image baru
        if ($request->hasFile('image')) {
            $fileCheck = 'required|max:1000|mimes:jpg,jpeg,png';
        } else {
            $fileCheck = '';
        }

        $rules = [
            'judul' => 'required',
            'image' => $fileCheck,
            'penulis' => 'required',
            'genre' => 'required',
            'desc' => 'required|min:20',
            'dokumen' => $fileCheck,
        ];

        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'image.required' => 'Image wajib diisi!',
            'penulis.required' => 'Penulis wajib diisi!',
            'genre.required' => 'Genre wajib diisi!',
            'desc.required' => 'Deskripsi wajib diisi!',
        ];

        $this->validate($request, $rules, $messages);

        // Cek jika ada image baru
        if ($request->hasFile('image')) {
            if (\File::exists('storage/buku/' . $buku->image)) {
                \File::delete('storage/buku/' . $request->old_image);
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/buku', $fileName);
        }

        if ($request->hasFile('image')) {
            $checkFileName = $fileName;
        } else {
            $checkFileName = $request->old_image;
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
                // $image = image::make($src)->resize(1200, 1200)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $buku->update([
            'judul' => $request->judul,
            'image' => $checkFileName,
            'penulis' => $request->penulis,
            'genre' => $request->genre,
            'desc' => $dom->saveHTML(),
            'dokumen' => $checkFileName
        ]);

        return redirect(route('blog'))->with('success', 'data berhasil di update');
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
}
