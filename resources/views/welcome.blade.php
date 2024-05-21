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

    {{-- berita --}}
    <section id="berita" class="py-5">
    <div class="container">

    <div class="header-koleksi text-center">
      <h2 class="fw-bold">Buku Terpopuler </h2>
    </div>

    <div class="row py-5" data-aos="flip-up">
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

    <div class="footer-koleksi text-center">
      <a href="/koleksi" class="btn btn-outline-danger">Buku Lainnya</a>
    </div>
    </div>
    </section>
    {{-- berita --}}

    {{-- Join --}}
    <section id="join" class="py-5" data-aos="flip-down">
    <iv class="container py-5">
    <div class="row d-flex align-items-center">
      <div class="col-lg-6">
        <div class="d-flex align-items-center mb-3">
          <div class="stripe me-2"></div>
            <h5>Daftar Anggota</h5>
          </div>
          <h1 class="fw-bold mb-2">Mari bergabung menjadi anggota perpustakaan kami, untuk meraih impian literasi kita!</h1>
          <p class="mb-3">
            mari bergabung sebagai anggota perpustakaan digital kami! 
            Dengan menjadi anggota, Anda akan mendapatkan akses tak terbatas 
            ke koleksi e-book, dan sumber referensi lainnya dari mana pun Anda berada. 
            Nikmati kenyamanan membaca dan belajar secara online, kapan pun dan di mana pun Anda inginkan. 
            Mulailah perjalanan literasi digital Anda bersama kami sekarang!
          </p>
          <button class="btn btn-outline-danger">Join</button>
        </div>
        <div class="col-lg-6">
          <img src="{{ asset('assets/images/member.jpg') }}" class="img-fluid" alt="">

        </div>
      </div>
    </div>
    </section>
    {{-- Join --}}

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



