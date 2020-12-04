<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_fetch_their_most_recent_reply()
    {
        $user = create('App\Model\User');
        $reply = create('App\Model\Reply', ['user_id' => $user->id]);
        $this->assertEquals($reply->id, $user->lastReply->id);
    }

    public function test_a_user_can_determine_their_avatar_path()
    {
        $user = create('App\Model\User');
        $this->assertEquals(asset('img/avatar.png'), $user->avatar_path);
        $user->avatar_path = 'avatars/me.jpg';
        $this->assertEquals(asset('storage/avatars/me.jpg'), $user->avatar_path);
    }
}
