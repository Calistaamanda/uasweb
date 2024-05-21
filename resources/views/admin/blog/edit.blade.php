@extends('layouts.layouts')

@section('content')
    <section class="py-5" style="margin-top: 100px">
        <div class="container col-xxl-8">

                        {{-- Navigasi --}}
                        <div class="d-flex">
                            <a href="{{ route('blog') }}">Buku</a>
                            <div class="mx-1"> . </div>
                            <a href="">Edit Buku</a>
                        </div>
            <h4>Halaman Buat Edit Buku</h4>

            <form action="{{ route('blog.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="">Masukkan Judul Buku</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                    value="{{ old('judul', $buku->judul) }}">
                    
                    @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="form-group mb-4">
                    <label for="">Pilih Gambar Buku</label>
                    <input type="hidden" name="old_image" value="{{ $buku->image }}">
                    <div>
                        <img src="{{ asset('storage/buku/'. $buku->image) }}" class="col-lg-4" alt="">
                    </div>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="form-group mb-4">
                    <label for="">Masukkan Nama Penulis</label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis"
                    value="{{ old('penulis', $buku->penulis) }}">
                    
                    @error('penulis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                    <div class="form-group mb-4">
                        <label for="">Masukkan Genre Buku</label>
                        <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre"
                        value="{{ old('genre', $buku->genre) }}">
                        
                        @error('genre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
    
                        <div class="form-group mb-4">
                            <label for="">Deskripsi Buku</label>
                            <textarea name="desc" id="summernote">
                                {!! $buku->desc !!}
                            </textarea>
                            
                            @error('desc')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                    @enderror
                </div>
    
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
    </section>
@endsection