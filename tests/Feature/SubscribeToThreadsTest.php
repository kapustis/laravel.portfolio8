<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class   SubscribeToThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_subscribe_to_threads()
    {
        $this->signIn();
        // Given we have a thread... // Учитывая, что у нас есть нить ...
        $thread = create('App\Models\Thread');
        // And the user subscribes to the thread...
        $this->post($thread->path() . '/subscription');
        $this->assertCount(1, $thread->fresh()->subscriptions);

    }

    public function test_a_user_can_unsubscribe_from_threads()
    {
        $this->signIn();
        $thread = create('App\Models\Thread');
        $thread->subscribe();
        $this->delete($thread->path() . '/subscription');
        $this->assertCount(0, $thread->subscriptions);
    }
}
