<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserNotificationsController extends Controller
{
    /**
     * UserNotificationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Fetch all unread notifications for the user.
     * Выборка всех непрочитанных уведомлении для пользователя.
     * @return mixed
     */
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }
    /**
     * Mark a specific notification as read.
     * Отметить определенное уведомление, как прочитанное
     * @param User $user
     * @param int  $notificationId
     */
    public function destroy(User $user, $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();

    }
}
