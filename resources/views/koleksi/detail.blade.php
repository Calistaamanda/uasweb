@extends('layouts.layouts')

@section('content')
<section id="detail" style="margin-top: 100px" class="py-5">
    <div class="container col-xxl-8">
        <div class="d-flex mb-3">
            <a href="/">Beranda</a> / <a href="/koleksi">Koleksi</a> / {{ $buku->judul }}
        </div>
        <img src="{{ asset('storage/buku/' . $buku->image) }}" class="img-fluid mb-3" alt="{{ $buku->judul }}" width="300">
        <div class="konten-berita">
            <p class="mb-3 text-secondary">{{ $buku->created_at }}</p>
            <h4 class="fw-bold mb-3">{{ $buku->judul }}</h4>
            <p class="text-secondary">{!! $buku->desc !!}</p>
        </div>
        <div class="mt-4">
            <p class="mb-3 text-muted">Baca selengkapnya</p> <!-- Tambahan teks "Baca selengkapnya" dengan warna pudar -->
            @if (Auth::check())
                <a href="{{ route('bukus.download', $buku->id) }}" class="btn btn-success">Unduh Buku</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Mengunduh</a>
            @endif
        </div>
    </div>
</section>
@endsection
