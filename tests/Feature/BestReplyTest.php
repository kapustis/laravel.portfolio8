<?php

namespace Tests\Feature;

use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BestReplyTest extends TestCase
{
    use RefreshDatabase;

    /** создатель темы может отметить любой ответ как лучший ответ **/
    public function test_a_thread_creator_may_mark_any_reply_as_the_best_reply()
    {
        $this->signIn();
        $thread = create('App\Model\Thread', ['user_id' => auth()->id()]);
        $replies = create('App\Model\Reply', ['thread_id' => $thread->id], 2);
        $this->assertFalse($replies[1]->isBest());
        $this->postJson(route('best-replies.store', [$replies[1]->id]));
        $this->assertTrue($replies[1]->fresh()->isBest());
    }

    /** только создатель темы может отметить ответ как лучший **/
    function test_only_the_thread_creator_may_mark_a_reply_as_best()
    {
        $this->withExceptionHandling();

        $this->signIn();
        $thread = create('App\Model\Thread', ['user_id' => auth()->id()]);
        $replies = create('App\Model\Reply', ['thread_id' => $thread->id], 2);
        $this->signIn(create('App\Model\User'));
        $this->postJson(route('best-replies.store', [$replies[1]->id]))->assertStatus(403);
        $this->assertFalse($replies[1]->fresh()->isBest());
    }

    /** если лучший ответ удален, цепочка обновляется должным образом, чтобы отразить это **/
    function test_if_a_best_reply_is_deleted_then_the_thread_is_properly_updated_to_reflect_that()
    {
        $this->signIn();
        $reply = create('App\Model\Reply', ['user_id' => auth()->id()]);
        $reply->thread->markBestReply($reply);
        $this->deleteJson(route('reply.destroy', $reply));
        $this->assertNull($reply->thread->fresh()->best_reply_id);
    }

}
