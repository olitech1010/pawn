<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Fetch all notifications for the authenticated user
        $notifications = auth()->user()->notifications()->get();
        return response()->json($notifications);
    }

    public function show($id)
    {
        // Fetch a specific notification for the authenticated user
        $notification = auth()->user()->notifications()->findOrFail($id);
        return response()->json($notification);
    }

    public function markAsRead($id)
    {
        // Mark a specific notification as read
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->update(['status' => 'Read']);
        return response()->json($notification);
    }

    public function store(Request $request)
    {
        // Create and send a custom notification (Admin only)
        $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'status' => 'Unread',
        ]);

        return response()->json($notification, 201);
    }
}
