@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pemberitahuan</h1>

        @foreach($notifications as $notification)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $notification->message }}</h5>
                    <p class="card-text">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach

        {{-- Tautan navigasi halaman --}}
        {{ $notifications->links() }}
    </div>
@endsection
