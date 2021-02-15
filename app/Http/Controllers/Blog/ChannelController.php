<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends BaseController
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
