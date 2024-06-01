@extends('layouts.layouts')

@section('content')
<section class="py-5" style="margin-top: 100px">
    <div class="container col-xxl-8">
        <h4 class="mb-4">Pemberitahuan</h4>
        @if($notifications->isEmpty())
            <div class="alert alert-info">Belum ada pemberitahuan.</div>
        @else
            <div class="list-group">
                @foreach ($notifications as $notification)
    <div class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $notification->title }}</h5>
            <small>{{ $notification->created_at->diffForHumans() }}</small>
        </div>
        <p class="mb-1">{{ $notification->message }}</p>
        @if (is_null($notification->read_at))
            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary mt-2">Tandai sebagai Dibaca</button>
            </form>
        @endif
    </div>
@endforeach

            </div>
        @endif
    </div>
</section>
@endsection
