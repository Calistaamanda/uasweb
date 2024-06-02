<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('assets/icons/logo.ico') }}">

    <title>VISI PUSTAKA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        {{-- AOS --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        {{-- Summernote CSS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{  asset('assets/css/style.css') }}">
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    <section id="footer" class="bg-white" data-aos="zoom-out">
        <div class="container py-4">
        <footer>
            <div class="row">
            {{-- Kolom 1 Navigasi --}}
            <div class="col-12 col-md-3 mb-3">
                <h5 class="fw-bold mb-3">Navigasi</h5>
                <div class="d-flex">
                <ul class="nav flex-column me-5">
                    <li class="nav-item mb-2"><a href="/koleksi" class="nav-link p-0 text-muted">Koleksi</a>
                    <li class="nav-item mb-2"><a href="login" 
                        class="nav-link p-0 text-muted">Bergabung</a></li>
                </div>
            </div>

            {{-- Kolom 2 Media Sosial --}}
            <div class="col-12 col-md-3 mb-3">
                <h5 class="font-inter fw-bold mb-3">Follow kami</h5>
                <div class="d-flex mb-3">
                <a href="" target="_blank" class="text-decoration-none text-dark">
                    <img src="{{ asset('assets/icons/instagram-icon.png') }}" height="30" width="30" 
                        class="me-4" alt="">
                </a>
                </div>
            </div>

            {{-- Kolom 3 Kontak --}}
            <div class="col-12 col-md-3 mb-3">
                <h5 class="font-inter fw-bold mb-3">Kontak Kami</h5>
                <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#"
                        class="nav-link p-0 text-muted">Visi@pustaka.id</a></li>
                <li class="nav-item mb-2"><a href="#"
                        class="nav-link p-0 text-muted">0811-xxx-xxx</a></li>
                <li class="nav-item mb-2"><a href="#"
                        class="nav-link p-0 text-muted">0821-xxx-xxx</a></li>
                </ul>
            </div>

            {{-- Kolom 4 Alamat --}}
            <div class="col-12 col-md-3 mb-3">
                <h5 class="font-inter fw-bold mb-3">Alamat</h5>
                <div class="map-responsive">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.372209878414!2d117.13470431547099!3d-0.4690905995215416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd683a675c8f5c3%3A0xb027a90c2f9c2b77!2sJl.%20Juanda%2C%20Samarinda%2C%20Kalimantan%20Timur!5e0!3m2!1sid!2sid!4v1622574225805!5m2!1sid!2sid" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <a href="https://maps.app.goo.gl/CzUih5HGgP9W7YBi8" class="nav-link p-0 text-muted" target="_blank">Lihat di Google Maps</a>
            </div>
            
            

            </div>
        </footer>
        </div>
    </section>

    <section class="bg-light border-top" data-aos="zoom-out">
        <div class="container py-4">
            <div class="d-flex justify-content-between">
                <div>
                    Visi Pustaka 
                </div>
                <div class="d-flex">
                    <p class="me-4">Syarat & Ketentuan </p>
                    <p>
                        <a href="/kebijakan" class="text-decoration-none text-dark">Kebijakan Privasi</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


        {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
        
        {{-- Summernote JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
                    $('#summernote').summernote({
                        height: 200,
                    });
        });
        
    const navbar = document.querySelector(".fixed-top");
    window.onscroll = () => {
        if (window.scrollY > 100) {
        navbar.classList.add("scroll-nav-active");
        navbar.classList.add("text-nav-active");
        } else {
        navbar.classList.remove("scroll-nav-active");
        }
    };


    // Animasi Aos
    AOS.init();
    </script>

    </body>

    </html>