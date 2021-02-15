<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_channel_consists_of_threads()
    {
        $channel = Channel::factory()->create();
        $thread = Thread::factory()->create(['channel_id' => $channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
