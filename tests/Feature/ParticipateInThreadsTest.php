<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post('/blog/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();
        $thread = create('App\Models\BlogThread');
        $reply = make('App\Models\BlogReply');
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    function test_a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Models\BlogThread');
        $reply = make('App\Models\BlogReply', ['body' => null]);

        $this->json('post', $thread->path() . '/replies', $reply->toArray())->assertStatus(422);
    }

    function test_unauthorized_users_cannot_delete_replies()
    {
        $this->withExceptionHandling();
        $reply = create('App\Models\BlogReply');
        $this->delete("/replies/{$reply->id}")->assertRedirect('login');
        $this->signIn()->delete("/replies/{$reply->id}")->assertStatus(403);
    }

    function test_authorized_users_can_delete_replies()
    {
        $this->signIn();
        $reply = create('App\Models\BlogReply', ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}")->assertStatus(302);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    function test_authorized_users_can_update_replies()
    {
        $this->signIn();
        $reply = create('App\Models\BlogReply', ['user_id' => auth()->id()]);
        $this->patch("/replies/{$reply->id}", ['body' => 'Text reply']);
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => 'Text reply']);
    }

    function test_reply_that_contain_spam_may_not_be_created()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $thread = create('App\Models\BlogThread');
        $reply = make('App\Models\BlogReply', ['body' => 'Yahoo Customer Support']);
        $this->json('post', $thread->path() . '/replies', $reply->toArray())->assertStatus(422);
    }

    function test_user_reply_post_reply_once_minute()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $thread = create('App\Models\BlogThread');
        $reply = make('App\Models\BlogReply');
        $this->post($thread->path() . '/replies', $reply->toArray())->assertStatus(201);
        $this->post($thread->path() . '/replies', $reply->toArray())->assertStatus(429);
    }

}
