@extends('layouts.layouts')

@section('content')
    <section class="py-5" style="margin-top: 100px">
        <div class="container col-xxl-12">
            <h4 class="mb-4">Halaman Daftar Berita</h4>

            <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Masukkan Berita</a>

            {{-- Pesan Sukses --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Informasi:</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive py-3">
                <table class="table table-bordered table-striped w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Isi Berita</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($beritas as $berita)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ strip_tags($berita->desc) }}</td>
                            <td>
                                {{-- <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning">Edit</a> --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $berita->id }}">Hapus</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $berita->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $berita->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $berita->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus buku <strong>{{ $berita->judul }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
