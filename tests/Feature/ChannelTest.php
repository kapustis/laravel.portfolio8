<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_channel_consists_of_threads()
    {
        $channel = factory('App\Model\Channel')->create();
        $thread = factory('App\Model\Thread')->create(['channel_id' => $channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
