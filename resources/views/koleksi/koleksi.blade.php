@extends('layouts.layouts')

@section('content')
    {{-- berita --}}
    <section id="berita" style="margin-top: 100px" class="py-5">
        <div class="container">
        <div class="header-koleksi text-center">
          <h2 class="fw-bold">Buku Terpopuler </h2>
        </div>
        <div class="row py-5">
          @foreach ($bukus as $item)
      <div class="col-lg-4">
        <div class="card border-0">
          <img src="{{ asset('storage/buku/', $item->image) }}" class="img-fluit mb-3" alt="">
          <div class="konten-koleksi">
            <p class="mb-3 text-secondary">{{ $item->create_at }}</p>
            <h4 class="fw-bold mb-3">{{ $item->judul }}</h4>
            <p class="text-secondary">#teenager</p>
            <a href="/detail/{{ $item->slug }}"
              class="text-decoration-none text-danger">Selengkapnya</a>
          </div>
        </div>
      </div>
      @endforeach
        </div>
        
        </div>
        </section>
        {{-- berita --}}
@endsection