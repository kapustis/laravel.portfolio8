<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
//use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilesController extends Controller
{
    /**
     * Show the user's profile.
     * Вывод профиля пользователя
     * @param  User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }
}
