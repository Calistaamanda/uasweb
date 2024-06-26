<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
{
    $notification = Notification::findOrFail($id);
    $notification->read_at = now();
    $notification->save();

    return redirect()->route('notifications.index')->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
}

}

