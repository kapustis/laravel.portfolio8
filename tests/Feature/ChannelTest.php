<?php

namespace Tests\Feature;

use App\Models\BlogChannel;
use App\Models\BlogThread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_channel_consists_of_threads()
    {
        $channel = BlogChannel::factory()->create();
        $thread = BlogThread::factory()->create(['channel_id' => $channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
