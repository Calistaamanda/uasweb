@extends('layouts.layouts')

@section('content')
    <section class="py-5" style="margin-top: 100px">
        <div class="container col-xxl-8">

            {{-- Navigasi --}}
            <div class="d-flex">
                <a href="{{ route('berita') }}">Berita</a>
                <div class="mx-1"> . </div>
                <a href="">Masukkan Berita</a>
            </div>

            <h4>Halaman Buat Daftar berita</h4>

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="">Masukkan Judul Berita</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                value="{{ old('judul') }}">
                
                @error('judul') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

                    <div class="form-group mb-4">
                        <label for="">Isi Berita</label>
                        <textarea name="isi" id="summernote">
                            {{ old('isi') }}
                        </textarea>
                        
                        @error('isi')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
    </section>
@endsection