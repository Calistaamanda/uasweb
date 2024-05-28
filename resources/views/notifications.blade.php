@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pemberitahuan</h1>
        <ul>
            @foreach($notifications as $notification)
                <li>
                    <h3>{{ $notification->title }}</h3>
                    <p>{{ $notification->message }}</p>
                    <small>{{ $notification->created_at }}</small>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
