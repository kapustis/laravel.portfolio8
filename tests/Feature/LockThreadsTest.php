<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LockThreadsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** Не администратор не может блокировать темы **/
    function testNonAdminMayNotLockThreads()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $thread = create('App\Model\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-blog.store', $thread))->assertStatus(403);
        $this->assertFalse($thread->fresh()->locked);
    }

    /** Администратор может заблокировать любую тему **/
    function testAnAdminCanLockAnyThread()
    {
        $this->signIn(factory('App\Model\User')->states('administrator')->create());
        $thread = create('App\Model\Thread', ['user_id' => auth()->id()]);
        $this->post(route('locked-blog.store', $thread));
        $this->assertTrue(!!$thread->fresh()->locked, 'Failed asserting that the thread was locked.');
    }

    function testAnAdminCanUnlockAnyThread()
    {
        $this->signIn(factory('App\Model\User')->states('administrator')->create());
        $thread = create('App\Model\Thread', ['user_id' => auth()->id(),'locked' => true]);
        $this->delete(route('locked-blog.destroy', $thread));
        $this->assertFalse($thread->fresh()->locked, 'Failed asserting that the thread was locked.');
    }

    /** После блокировки тема может не получить ответ **/
    public function testOnceLockedAThreadMayNotReceiveNewReply()
    {
        $this->signIn();
        $thread = create('App\Model\Thread', ['locked' => true]);

        $this->post($thread->path() . '/replies', [
            'user_id' => create('App\Model\User')->id,
            'body' => 'New reply body'
        ])->assertStatus(422);
    }
}
