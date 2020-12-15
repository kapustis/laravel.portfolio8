<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('channel.create');
    }

    public function store(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'name' => 'required|max:50',
            'slug' => 'required|max:50',
        ]);

        $channel = Channel::create([
            'name' => request('name'),
            'slug' => request('slug')
        ]);

        return back();
    }

}
