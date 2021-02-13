<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentionUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_mentioned_users_in_a_reply_are_notified()
    {
        $userOne = create('App\Models\User',['name' => 'UserOne']);
        $this->signIn($userOne);
        $userTwo = create('App\Models\User',['name' => 'user']);
        $thread = create('App\Models\BlogThread');
        $reply = make('App\Models\BlogReply', ['body' => '@user look at this.']);
        $this->json('post', $thread->path() . '/replies', $reply->toArray());
        $this->assertCount(1,$userTwo->notifications);
    }
    function test_it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
    {
        create('App\Models\User', ['name' => 'UserOne']);
        create('App\Models\User', ['name' => 'UserTwo']);
        create('App\Models\User', ['name' => 'Admin']);

        $results = $this->json('GET', '/api/users', ['name' => 'Use']);

        $this->assertCount(2, $results->json());
    }
}
