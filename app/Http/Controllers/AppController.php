<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'bukus'=> Buku::orderBy('id', 'desc')->limit(3)->get()
        ]);
    }

    public function koleksi()
    {
        return view('koleksi.koleksi', [
            'bukus'=> Buku::orderBy('id', 'desc')->get()
        ]);
    }

    public function detail($slug)
    {
        $buku=Buku::where('slug', $slug)->first();
        return view('koleksi.detail', [
            'buku'=> $buku
        ]);
    }
}
