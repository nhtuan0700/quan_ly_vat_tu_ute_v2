<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $userRepo;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRepo = $userInterface;
    }

    public function markAsRead()
    {
        $user = $this->userRepo->find(auth()->id());
        $user->unreadNotifications()->update(['read_at' => now()]);
        return response()->json([
            'success' => true
        ]);
    }

    public function list(Request $request)
    {
        $user = $this->userRepo->find(auth()->id());
        $notifications = $user->notifications()->select('data', 'created_at', 'read_at')->paginate(5);
        $count_unread = $user->unreadNotifications->count();
        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'count_unread' => $count_unread,
            'lastPage' => $notifications->lastPage(),
        ]);
    }
}
