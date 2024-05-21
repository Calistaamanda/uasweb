@extends('layouts.layouts')

@section('content')
    <section class="py-5" style="margin-top: 100px">
        <div class="container col-xxl-8">
            

            <h4>Halaman Daftar Buku</h4>

            <a href="{{ route('blog.create') }}" class="btn btn-primary">Masukkan Buku</a>

            {{-- Pesan Sukses --}}
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Informasi</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>                
            @endif

            <div class="table-responsive py-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Genre</th>
                            <th>Desc</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <img src="{{ asset('storage/buku/'. $buku->image) }}" height="100" alt="">
                            </td>
                            <td>
                                {{ $buku->judul }}
                            </td>
                            <td>
                                {{ $buku->penulis }}
                            </td>
                            <td>
                                {{ $buku->genre }}
                            </td>
                            <td>
                                {{ $buku->desc }}
                            </td>
                            <td>
                                <a href="{{ asset('storage/dokumen/'. $buku->dokumen) }}" class="btn btn-success" download>Download></a>
                            </td>
                            <td>
                                <a href="{{ route('blog.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('blog.destroy', $buku->id) }}" method="POST" 
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" onclick="alert('Apakah yakin akan di hapus ?')" 
                                    class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
    </section>
@endsection