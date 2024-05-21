@extends('layouts.layouts')

@section('content')
    <section id="detail" style="margin-top: 100px" class="py-5">
        <div class="container col-xxl-8">
            <div class="d-flex mb-3">
                <a href="/">Beranda</a> / <a href="/koleksi">Koleksi</a> / Rembulan Tenggelam di Wajahmu - Tere Liye
            </div>
            <img src="{{ asset('storage/buku/', $buku->image) }}" class="img-fluit mb-3" alt="" width="300">
              <div class="konten-berita">
                <p class="mb-3 text-secondary">{{ $buku->create_at }}</p>
                <h4 class="fw-bold mb-3"> {{ $buku->judul }}</h4>
                <p class="text-secondary">{!! $buku->desc !!}</p>
              </div>
        </div>
    </section>
@endsection