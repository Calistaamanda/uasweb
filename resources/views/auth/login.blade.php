@extends('layouts.layouts')

@section('content')
<section style="margin-top: 100px">
    <div class="container py-5 col-xxl-6">
        <h3 class="fw-bold mb-3">Halaman Login Admin Perpustakaan</h3>

        @if (session('loginError'))
            <div class="alert alert-danger">
                {{ session('loginError') }}
            </div>
        @endif
        
        <form action="/login" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="">Masukan Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="">Masukan Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</section>
@endsection
