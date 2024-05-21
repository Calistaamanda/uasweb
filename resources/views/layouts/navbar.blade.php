    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg py-3 fixed-top {{ Request::segment(1) == '' ? ''
    : 'bg-white shadow' }}">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="{{  asset('assets/icons/logo.ico') }}" height="80" width="90" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="#">Tentang Kami</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active"  href="#">Pemberitahuan</a>
              </li>
              

              </li>
            </ul>
            <div class="d-flex">
              @auth
                  <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark">Logout</button>
                  </form>
                @else
                  <button class="btn btn-danger">Masuk</button>
              @endauth
            </div>
          </div>
        </div>
      </nav>
    {{-- Navbar --}} 
    