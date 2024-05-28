@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pemberitahuan</h1>

        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item">{{ $notification->data['message'] }}</li>
            @endforeach
        </ul>

        {{ $notifications->links() }}
    </div>
@endsection
