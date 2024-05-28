@extends('layouts.layouts')

@section('content')
    {{-- berita --}}
    <section id="berita" style="margin-top: 100px" class="py-5">
        <div class="container">
            <div class="header-koleksi text-center">
                <h2 class="fw-bold">Koleksi Buku</h2>
            </div>
            {{-- Form Pencarian --}}
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <form action="{{ route('koleksi.search') }}" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" name="query" placeholder="Cari buku atau penulis..." aria-label="Search" value="{{ $query ?? '' }}">
                        <button class="btn btn-outline-danger" type="submit">Cari</button>
                    </form>
                </div>
            </div>
            {{-- Menampilkan hasil pencarian --}}
            <div class="row py-5">
                @if(count($bukus) > 0)
                    @foreach ($bukus as $item)
                        <div class="col-lg-4">
                            <div class="card border-0">
                                <img src="{{ asset('storage/buku/' . $item->image) }}" class="img-thumbnail mb-3" alt="{{ $item->judul }}">
                                <div class="konten-koleksi">
                                    <p class="mb-3 text-secondary">{{ $item->created_at->format('Y-m-d') }}</p>
                                    <h4 class="fw-bold mb-3">{{ $item->judul }}</h4>
                                    <p class="mb-3">Penulis: {{ $item->penulis }}</p>
                                    <a href="/detail/{{ $item->slug }}" class="text-decoration-none text-danger">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center">
                        <p>Tidak ada hasil untuk pencarian "{{ $query }}"</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    {{-- berita --}}
@endsection
