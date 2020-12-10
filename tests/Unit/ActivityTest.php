<?php

namespace Tests\Unit;

use App\Models\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();
        $thread = create('App\Model\Thread');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Model\Thread'
        ]);

        $activity = Activity::first();
        $this->assertEquals($activity->subject->id, $thread->id);
    }

    public function test_it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();
        $reply = create('App\Model\Reply');
        $this->assertEquals(2, Activity::count());
    }

    public function test_it_fetches_a_feed_for_any_user()
    {
        // Given we have a thread
        $this->signIn();
        create('App\Model\Thread', ['user_id' => auth()->id()],2);
        // And another thread from a week ago

        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);
        // When we fetch their feed
        $feed = Activity::feed(auth()->user());
        //Then , it should be returned in the proper format
        $this->assertTrue($feed->keys()->contains(Carbon::now()->format('Y-m-d')));
        $this->assertTrue($feed->keys()->contains(Carbon::now()->subWeek()->format('Y-m-d')));
    }
}
