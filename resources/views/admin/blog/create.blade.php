@extends('layouts.layouts')

@section('content')
    <section class="py-5" style="margin-top: 100px">
        <div class="container col-xxl-8">

            {{-- Navigasi --}}
            <div class="d-flex">
                <a href="{{ route('blog') }}">Buku</a>
                <div class="mx-1"> . </div>
                <a href="">Masukkan Buku</a>
            </div>

            <h4>Halaman Buat Daftar Buku</h4>

            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="">Masukkan Judul Buku</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                value="{{ old('judul') }}">
                
                @error('judul')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="">Pilih Gambar Buku</label>
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
                value="{{ old('penulis') }}">
                
                @error('penulis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

                <div class="form-group mb-4">
                    <label for="">Masukkan Genre Buku</label>
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre"
                    value="{{ old('genre') }}">
                    
                    @error('genre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                    <div class="form-group mb-4">
                        <label for="">Deskripsi Buku</label>
                        <textarea name="desc" id="summernote">
                            {{ old('desc') }}
                        </textarea>
                        
                        @error('desc')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                @enderror
            </div>

            <div clas="form-group row">
                <label for="dokumen" class="col-md-4 col-form-label
                text-md-right">Dokumen*</label>
                
                <div class="col-md-8">
                    <input type="file" class="form-control" name="dokumen"
                    value="{{ old('dokumen') }}">
            
                    @error('dokumen')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
    </section>
@endsection