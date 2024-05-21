@extends('layouts.layouts')

@section('content')
    <section style="margin-top: 100px">
        <div class="container col-xxl-8 py-5">
            <h3 class="fw-bold mb-3">Halaman Dashboard Admin</h3>
            <p>Selamat datang di halaman dashboard admin</p>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm rounded-3 border-0">
                        <img src="{{ asset('assets/images/poto-menyusun-buku.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Buku-buku perpustakaan</h5>
                          <p class="card-text">Atur dan kelola daftar-daftar buku</p>
                          <a href="{{ route('blog') }}" class="btn btn-primary">Detail</a>
                        </div>
                      </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm rounded-3 border-0">
                        <img src="{{ asset('assets/images/books.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Photo Buku-buku</h5>
                          <p class="card-text">Atur dan kelola daftar-daftar buku</p>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
@endsection