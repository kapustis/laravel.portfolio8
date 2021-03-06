<?php

namespace Tests\Unit;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ThreadWasUpdate;
use Tests\TestCase;


class ThreadTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp() :void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = Thread::factory()->create();
    }


    function test_a_thread_a_path()
    {
        $thread = create('App\Models\Thread');
        $this->assertEquals("/blog/{$thread->channel->slug}/{$thread->slug}", $thread->path());
    }

    function test_a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }


    function test_a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\Models\User', $this->thread->creator);
    }


    public function test_a_thread_can_add_a_reply()
    {
        $this->thread->addReply(['body' => 'Text', 'user_id' => 1]);
        $this->assertCount(1, $this->thread->replies);
    }

    public function test_a_thread_notifies_all_registered_subscribers_when_a_reply_is_added()
    {
        Notification::fake();
        $this->signIn()->thread->subscribe()->addReply(['body' => 'Text', 'user_id' => 1]);
        Notification::assertSentTo(auth()->user(),ThreadWasUpdate::class);
    }


    function test_a_thread_belongs_to_a_channel()
    {
        $thread = create('App\Models\Thread');
        $this->assertInstanceOf('App\Models\Channel', $thread->channel);
    }

    function test_a_thread_can_be_subscribed_to()
        /** поток может быть подписан на... */
    {
        $this->withoutExceptionHandling();
        $thread = create('App\Models\Thread');
        $thread->subscribe($userId = 1);
        $this->assertEquals(1, $thread->subscriptions()->where('user_id', $userId)->count());
    }

    function test_a_thread_can_be_unsubscribe_from()
        /** аннулировать подписку */
    {
        $thread = create('App\Models\Thread');
        $thread->unsubscribe($userId = 1);
        $this->assertCount(0, $thread->subscriptions);
    }

    function test_it_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
        $thread = create('App\Models\Thread');
        $this->signIn();
        $this->assertFalse($thread->isSubscribedTo);
        $thread->subscribe();
        $this->assertTrue($thread->isSubscribedTo);
    }

    function test_a_thread_can_check_if_the_authenticated_user_has_read_all_replies()
    {
        $this->signIn();
        $thread = create('App\Models\Thread');
        tap(auth()->user(), function ($user) use ($thread) {
            $this->assertTrue($thread->hasUpdatesFor($user));
            $user->read($thread);
            $this->assertFalse($thread->hasUpdatesFor($user));
        });
    }

    function test_a_thread_records_each_visit(){
        $thread = create('App\Models\Thread');
        $this->assertSame(0, $thread->views);
        $this->call('GET', $thread->path());
        $this->assertEquals(1, $thread->fresh()->views);
    }

    function test_a_thread_records_each_visit_2(){
        $thread = create('App\Models\Thread');
        $thread->visits()->reset();
        $this->assertSame(0,$thread->visits()->count());
        $thread->visits()->record();
        $this->assertEquals(1, $thread->visits()->count());
    }
}
