<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $search = request('name');
        return  User::where('name', 'LIKE', "%$search%")->pluck('name');
    }
}
