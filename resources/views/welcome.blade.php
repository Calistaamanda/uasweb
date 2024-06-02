@extends('layouts.layouts')

@section('content')
    <section id="hero" class="px-0">
      <div class="container text-center text-white">
          <div class="hero-title" data-aos="fade-up">
            <div class="hero-text"> Selamat Datang <br> Di Visi Pustaka</div>
            <h4>Menyelami Ilmu Di Era Digital</h4>
          </div>
      </div>
    </section>

    <section id="program" style="margin-top: -30px">
    <div class="container col-xxl-9">
      <div class="row">
        <div class="col-lg-4 col-md-6 col mb-2" data-aos="flip-left">
          <div class="bg-white rounded-3 shadow p-3 mb-2 d-flex justify-content-between align-items-center">
            <div>
              <h5>Mudah <br> Diakses</h5>
            </div>
            <img src="{{ asset('assets/icons/gadget.png') }}" height="55" width="55" alt="">
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col mb-2" data-aos="flip-left">
          <div class="bg-white rounded-3 shadow p-3 mb-2 d-flex justify-content-between align-items-center">
            <div>
              <h5>Kemudahan <br> Pencarian</h5>
            </div>
            <img src="{{ asset('assets/icons/find.png') }}" height="55" width="55" alt="">
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col mb-2" data-aos="flip-left">
          <div class="bg-white rounded-3 shadow p-3 mb-2 d-flex justify-content-between align-items-center">
            <div>
              <h5>Ketersediaan <br> 24/7</h5>
            </div>
            <img src="{{ asset('assets/icons/time.png') }}" height="55" width="55" alt="">
          </div>
        </div>
      </div>
    </section>

    {{-- koleksi --}}
    <section id="berita" class="py-5">
    <div class="container">

    <div class="header-koleksi text-center">
      <h2 class="fw-bold">Koleksi Buku </h2>
    </div>

    <div class="row py-5" data-aos="flip-up">
      @foreach ($bukus as $item)
      <div class="col-lg-4">
        <div class="card border-0">
          <img src="{{ asset('storage/buku/' . $item->image) }}" class="img-fluid mb-3" alt="">
          <div class="konten-koleksi">
            <p class="mb-3 text-secondary">{{ $item->create_at }}</p>
            <h4 class="fw-bold mb-3">{{ $item->judul }}</h4>
            <a href="/detail/{{ $item->slug }}" 
              class="text-decoration-none text-danger">Selengkapnya</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="footer-koleksi text-center">
      <a href="/koleksi" class="btn btn-outline-danger">Buku Lainnya</a>
    </div>
    </div>
    </section>
    {{-- koleksi --}}

    <!-- berita buku baru -->
    <section id="berita" class="py-5">
      <div class="container">
          <div class="header-koleksi text-center">
              <h2 class="fw-bold">Berita Terkini</h2>
          </div>
  
          <div class="row py-5" data-aos="flip-up">
              @foreach ($bukus as $item)
              <div class="col-lg-4">
                  <div class="card border-0 shadow">
                      <div class="card-body">
                        <h5 class="fw-bold mb-3">Admin baru saja menambahkan buku baru</h5>
                          <p class="card-text text-secondary mb-2">{{ $item->created_at->format('d F Y') }}</p>
                          <h5 class="card-title fw-bold mb-3">{{ $item->judul }}</h5>
                          <p class="card-text mb-3">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                          <a href="/detail/{{ $item->slug }}" class="btn btn-danger">Klik untuk baca</a>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </section>
<!-- berita buku baru -->

    {{-- Video --}}
    <section id="video" class="py-5" data-aos="zoom-in">
    <div class="container py-5">
    <div class="text-center">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/1fp_gdNKjV4?si=NMAQnC-3YuDQpkqD" 
      title="YouTube video player" frameborder="0" 
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" 
      allowfullscreen></iframe>
    </div>
    </div>
    </section>
    {{-- Video --}}
@endsection



