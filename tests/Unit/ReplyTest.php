<?php

namespace Tests\Unit;


use App\Models\BlogReply;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
	use DatabaseMigrations, RefreshDatabase;

	/** @test */
	public function it_has_an_owner()
	{
		$reply = BlogReply::factory()->create();
		$this->assertInstanceOf('App\Models\User', $reply->owner);
	}

	function test_it_knows_if_it_was_just_published()
	{
		$reply = create('App\Models\BlogReply');
		$this->assertTrue($reply->wasJustPublished());
		$reply->created_at = Carbon::now()->subDay();
		$this->assertFalse($reply->wasJustPublished());
	}

	function test_it_can_detect_all_mentioned_users_in_the_body()
	{
		$reply = create('App\Models\BlogReply', ['body' => '@UserOne wants to talk to @UserTwo']);
		$this->assertEquals(['UserOne', 'UserTwo'], $reply->mentionedUsers());
	}

	/** "отмечен ли текущий ответ как лучший?" **/
	function test_it_knows_if_it_is_the_best_reply()
	{
		$reply = create('App\Models\BlogReply');
		$this->assertFalse($reply->isBest());
		$reply->thread->update(['best_reply_id' => $reply->id]);
		$this->assertTrue($reply->fresh()->isBest());
	}
}
